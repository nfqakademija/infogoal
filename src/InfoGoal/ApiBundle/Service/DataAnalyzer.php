<?php
/**
 * Created by PhpStorm.
 * User: Ernestas
 * Date: 2015-04-14
 * Time: 11:18
 */

namespace InfoGoal\ApiBundle\Service;

use Doctrine\ORM\EntityManager;
use InfoGoal\KickerBundle\Entity\TableOption;
use Symfony\Component\HttpFoundation\Response;
use InfoGoal\KickerBundle\Entity\Game;
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

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

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
        $gameTimeOut = $this->options['last_event_time'] < strtotime('-5 minutes', strtotime('now')) ? true : false;

        // are there any new events?
        $unreadEvents = sizeof($this->events) > 0;

        if (!$unreadEvents && $this->gameIsStarted && $gameTimeOut) {
            $this->markGameEnd(strtotime('now'));
        }

        if ($unreadEvents) {
            $this->analyzeEvents();
        }

        $this->saveOptions();

        return new Response(print_r($this->events, true));
    }

    public function analyzeEvents()
    {
        foreach ($this->events as $event) {
            // save state before current event
            $gameIsStarted = $this->gameIsStarted;
            if ($gameIsStarted) {
                if ($this->options['last_event_time'] < strtotime('-5 minutes', $event['timeSec'])) {
                    $this->markGameEnd($this->options['last_event_time']);
                    $this->markGameStart($event['timeSec']);
                }
            } else {
                $this->markGameStart($event['timeSec']);
            }
            $this->switchEvent($event, $gameIsStarted);

            $this->options['last_event_time'] = $event['timeSec'];
            $this->options['last_event_id'] = $event['id'];
        }
    }

    /**
     * @param array $event
     * @param boolean $gameStateBeforeEvent
     */
    public function switchEvent($event, $gameStartedBeforeEvent)
    {
        switch ($event['type']) {
            case "AutoGoal":
                $this->eventAutoGoal($event['data'], $event['timeSec']);
                break;
            case "CardSwipe":
                $this->eventCardSwipe($event['data'], $event['timeSec'], $gameStartedBeforeEvent);
                break;
        }
    }

    public function eventAutoGoal($eventData, $eventTime)
    {
        $goal = json_decode($eventData);
        if ($goal->team == 0) {
            $this->activeGame->setGoal1();
            $teamGoalsCount = $this->activeGame->getGoal1();
        } else {
            $this->activeGame->setGoal2();
            $teamGoalsCount = $this->activeGame->getGoal2();
        }

        $this->em->flush();

        if ($teamGoalsCount == 10) {
            $this->markGameEnd($eventTime);
        }
    }

    public function eventCardSwipe($eventData, $eventTime, $gameStartedBeforeEvent)
    {
        $cardSwipe = json_decode($eventData);
        if ($gameStartedBeforeEvent) {
            $this->markGameEnd($this->options['last_event_time']);
            $this->markGameStart($eventTime);
        }

        $player = (string)$cardSwipe->team . $cardSwipe->player;
        switch ($player) {
            case "00":
                $this->activeGame->setPlayer1($cardSwipe->card_id);
                break;
            case "01":
                $this->activeGame->setPlayer2($cardSwipe->card_id);
                break;
            case "10":
                $this->activeGame->setPlayer3($cardSwipe->card_id);
                break;
            case "11":
                $this->activeGame->setPlayer4($cardSwipe->card_id);
                break;
        }

        $this->em->flush();
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

            $this->em->flush();
        }
    }

    /**
     * @param timestamp $time
     */
    public function markGameEnd($time)
    {
        $this->gameIsStarted = false;
        $this->markTableState(0);

        $date = new DateTime();
        $date->setTimestamp($time);
        $this->activeGame->setDateEnd($date);
        $this->em->flush();
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
} 