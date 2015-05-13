<?php

namespace InfoGoal\ApiBundle\Service;

use Doctrine\ORM\EntityManager;
use InfoGoal\KickerBundle\Entity\TableOption;
use Symfony\Component\HttpFoundation\Response;
use InfoGoal\KickerBundle\Entity\Game;
use InfoGoal\KickerBundle\Entity\Player;
use DateTime;

class DataAnalyzer
{

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var array
     */
    private $events = [];

    /**
     * @var array
     */
    private $options;

    /**
     * @var boolean
     */
    private $gameIsStarted;

    /**
     * @var Game
     */
    private $activeGame;

    /**
     * @var ExpCalculator
     */
    private $calculator;

    /**
     * @var Achievements
     */
    private $achievements;

    public function __construct(EntityManager $em, ExpCalculator $calculator, Achievements $achievements)
    {
        $this->em = $em;
        $this->calculator = $calculator;
        $this->achievements = $achievements;
    }

    /**
     * @param array $options
     */
    public function setOptions($options)
    {
        foreach ($options as $option) {
            $this->options[$option->getOptionKey()] = $option->getOptionValue();
        }

        if (!isset($this->options['table_state'])) {
            $this->options['table_state'] = 0;
        }

        if (!isset($this->options['last_event_time'])) {
            $this->options['last_event_time'] = strtotime('1900');
        }

        if (!isset($this->options['last_event_id'])) {
            $this->options['last_event_id'] = 0;
        }

        if (!isset($this->options['active_game_id'])) {
            $this->options['active_game_id'] = 0;
        }
    }

    /**
     * @param array $events
     * @param array $options
     * @return Response
     */
    public function analyze($events, $options)
    {
        $this->setOptions($options);

        $this->events = $events;

        $this->gameIsStarted = $this->options['table_state'] == 1 ? true : false;

        if ($this->gameIsStarted) {
            $repository = $this->em->getRepository('InfoGoalKickerBundle:Game');
            $this->activeGame = $repository->find($this->options['active_game_id']);
        }

        // is the game time out?
        $gameTimeOut = $this->options['last_event_time'] < strtotime('-1 minutes', strtotime('now')) ? true : false;

        // are there any new events?
        $unreadEvents = sizeof($this->events) > 0;

        if (!$unreadEvents && $this->gameIsStarted && $gameTimeOut) {
            $this->markGameEnd(strtotime('now'));
        }

        if ($unreadEvents) {
            $this->analyzeEvents();
        }

        $this->saveOptions();

        return new Response(print_r($this->events, 1));
    }

    public function analyzeEvents()
    {
        foreach ($this->events as $event) {
            if ($this->options['last_event_id'] !== 0) {
                if ($this->gameIsStarted) {
                    if ($this->options['last_event_time'] < strtotime('-1 minutes', $event['timeSec'])) {
                        $this->markGameEnd($this->options['last_event_time']);
                        $this->markGameStart($event['timeSec']);
                    }
                } else {
                    $this->markGameStart($event['timeSec']);
                }
                $this->switchEvent($event);
            }
            $this->options['last_event_time'] = $event['timeSec'];
            $this->options['last_event_id'] = $event['id'];
        }
    }

    /**
     * @param array $event
     */
    public function switchEvent($event)
    {
        switch ($event['type']) {
            case "AutoGoal":
                $this->eventAutoGoal($event['data'], $event['timeSec']);
                break;
            case "CardSwipe":
                $this->eventCardSwipe($event['data'], $event['timeSec']);
                break;
        }
    }

    /**
     * @param json $eventData
     * @param timestamp $eventTime
     */
    public function eventAutoGoal($eventData, $eventTime)
    {
        $goal = json_decode($eventData);

        $players = array();

        if ($goal->team == 0) {
            $this->activeGame->setGoal1();
            $teamGoalsCount = $this->activeGame->getGoal1();

            array_push($players, $this->activeGame->getPlayer1(),
                $this->activeGame->getPlayer2());

        } else {
            $this->activeGame->setGoal2();
            $teamGoalsCount = $this->activeGame->getGoal2();

            array_push($players, $this->activeGame->getPlayer3(),
                $this->activeGame->getPlayer4());

        }

        $this->calculator->CalculateGoal($players);

        $this->em->flush();

        if ($teamGoalsCount == 10) {
            $this->markGameEnd($eventTime);
        }
    }

    public function eventCardSwipe($eventData, $eventTime)
    {
        $cardSwipe = json_decode($eventData);
        $playingPlayersIds = $this->activeGame->getAllPlayersIds();
        $whichPlayer = (string)$cardSwipe->team . $cardSwipe->player;

        $player = $this->em->getRepository('InfoGoalKickerBundle:Player')->findOneByCardId($cardSwipe->card_id);
        if (!$player) {
            $player = new Player();
            $player->setCardId($cardSwipe->card_id);
            $player->setName("Guest" . $cardSwipe->card_id);
            $player->setPhoto("");
            $this->em->persist($player);
        }

        switch ($whichPlayer) {
            case "00":
                $positionPlayer = $this->activeGame->getPlayer1();
                $positionOccupied = !is_null($positionPlayer) || in_array($player->getId(), $playingPlayersIds);
                $positionPlayerId = is_null($positionPlayer) ? 0 : $positionPlayer->getId();
                $cardSwipeToSamePosition = $positionPlayerId == $player->getId();
                if ($positionOccupied && !$cardSwipeToSamePosition) {
                    $this->finishOldStartNew($eventTime);
                }
                $this->activeGame->setPlayer1($player);
                break;
            case "01":
                $positionPlayer = $this->activeGame->getPlayer2();
                $positionOccupied = !is_null($positionPlayer) || in_array($player->getId(), $playingPlayersIds);
                $positionPlayerId = is_null($positionPlayer) ? 0 : $positionPlayer->getId();
                $cardSwipeToSamePosition = $positionPlayerId == $player->getId();
                if ($positionOccupied && !$cardSwipeToSamePosition) {
                    $this->finishOldStartNew($eventTime);
                }
                $this->activeGame->setPlayer2($player);
                break;
            case "10":
                $positionPlayer = $this->activeGame->getPlayer3();
                $positionOccupied = !is_null($positionPlayer) || in_array($player->getId(), $playingPlayersIds);
                $positionPlayerId = is_null($positionPlayer) ? 0 : $positionPlayer->getId();
                $cardSwipeToSamePosition = $positionPlayerId == $player->getId();
                if ($positionOccupied && !$cardSwipeToSamePosition) {
                    $this->finishOldStartNew($eventTime);
                }
                $this->activeGame->setPlayer3($player);
                break;
            case "11":
                $positionPlayer = $this->activeGame->getPlayer4();
                $positionOccupied = !is_null($positionPlayer) || in_array($player->getId(), $playingPlayersIds);
                $positionPlayerId = is_null($positionPlayer) ? 0 : $positionPlayer->getId();
                $cardSwipeToSamePosition = $positionPlayerId == $player->getId();
                if ($positionOccupied && !$cardSwipeToSamePosition) {
                    $this->finishOldStartNew($eventTime);
                }
                $this->activeGame->setPlayer4($player);
                break;
        }
    }

    public function finishOldStartNew($eventTime)
    {
        $this->markGameEnd($this->options['last_event_time']);
        $this->markGameStart($eventTime);
    }

    public function saveOptions()
    {
        // save options or create if not exist
        $repository = $this->em->getRepository('InfoGoalKickerBundle:TableOption');
        foreach ($this->options as $optionKey => $optionValue) {
            $option = $repository->findOneByOptionKey($optionKey);
            if (!$option) {
                $option = new TableOption();
                $this->em->persist($option);
            }

            $option->setOptionKey($optionKey);
            $option->setOptionValue($optionValue);
        }

        $this->em->flush();
    }

    /**
     * @param timestamp $time
     */
    public function markGameEnd($time)
    {
        sleep(3);
        $this->gameIsStarted = false;
        $this->markTableState(0);

        $date = new DateTime();
        $date->setTimestamp($time);
        $this->activeGame->setDateEnd($date);

        $noGoals = $this->activeGame->getGoal1() + $this->activeGame->getGoal2() < 1;
        $onlyAnonymous = sizeof($this->activeGame->getAllPlayersIds()) == 0;

        if ($noGoals || $onlyAnonymous)
            $this->em->remove($this->activeGame);

        $this->em->flush();

        $this->calculator->CalculateGame($this->activeGame);
        $this->achievements->checkBadges($this->activeGame);

    }

    /**
     * @param timestamp $time
     */
    public function markGameStart($time)
    {
        $this->gameIsStarted = true;
        $this->markTableState(1);

        $game = new Game();
        $date = new DateTime();
        $date->setTimestamp($time);
        $game->setDateStart($date);
        $this->em->persist($game);
        $this->em->flush();

        $this->activeGame = $game;
        $this->options['active_game_id'] = $this->activeGame->getId();
    }

    /**
     * @param boolean $isFree
     */
    public function markTableState($state)
    {
        $this->options['table_state'] = $state;
    }

    /**
     * @param Game $game
     */
    public function setActiveGame(Game $game)
    {
        $this->activeGame = $game;
    }

    /**
     * @return bool
     */
    public function getGameIsStarted()
    {
        return $this->gameIsStarted;
    }

    /**
     * @return Game
     */
    public function getActiveGame()
    {
        return $this->activeGame;
    }
} 