<?php
/**
 * Created by PhpStorm.
 * User: Ernestas
 * Date: 2015-04-14
 * Time: 11:18
 */

namespace InfoGoal\KickerBundle\Service;

use Doctrine\ORM\EntityManager;
use InfoGoal\KickerBundle\Entity\TableOption;
use InfoGoal\KickerBundle\Entity\TableOptionRepository;
use Symfony\Component\HttpFoundation\Response;

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

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param array $events
     * @param array $options
     * @return Response
     */
    public function analyze($events, $options)
    {
        if (!isset($options['table_state'])) {
            $options['table_state'] = 1;
        }

        if (!isset($options['last_event_time'])) {
            $options['last_event_time'] = strtotime('now');
        }

        $this->options = $options;
        $this->events = $events;
        $this->gameIsStarted = $options['table_state'] == 1 ? true : false;

        // is the game time out?
        $gameTimeOut = $options['last_event_time'] > strtotime('-5 minutes', strtotime('now')) ? true : false;

        // are there any new events?
        $unreadEvents = sizeof($this->events) > 0;

        if(!$unreadEvents && $this->gameIsStarted && $gameTimeOut){
            $this->markGameEnd(strtotime('now'));
            $this->markTableState(true);
        }

        if ($unreadEvents) {
            $this->analyzeEvents();
        }

        $this->saveOptions();

        return new Response(print_r($events, true));
    }

    public function analyzeEvents()
    {
        foreach ($this->events as $event) {
            $gameState = $this->gameIsStarted;
            if ($gameState) {
                if ($this->options['last_event_time'] > strtotime('-5 minutes', $event['timeSec'])) {
                    $this->markGameEnd($this->options['last_event_time']);
                    $this->markGameStart($event['timeSec']);
                }
            } else {
                $this->markTableState(false);
                $this->markGameStart($event['timeSec']);
            }
            $this->switchEvent($event, $gameState);

            $this->options['last_event_time'] = $event['timeSec'];
            $this->options['last_event_id'] = $event['id'];
        }
    }

    /**
     * @param array $event
     * @param boolean $gameStateBeforeEvent
     */
    public function switchEvent($event, $gameStateBeforeEvent)
    {
        switch ($event['type']) {
            case "AutoGoal":
                // do actions
                break;
            case "CardSwipe":
                // do actions
                break;
        }
    }

    public function saveOptions()
    {
        $repository = $this->em->getRepository('InfoGoalKickerBundle:TableOption');
        // save options or create if not exist
    }

    /**
     * @param timestamp $time
     */
    public function markGameEnd($time)
    {
        $this->gameIsStarted = false;
        // write game end time to DB
    }

    /**
     * @param timestamp $time
     */
    public function markGameStart($time)
    {
        $this->gameIsStarted = true;
        // write new game to DB
    }

    /**
     * @param boolean $isFree
     */
    public function markTableState($isFree)
    {
        // mark table free or taken
    }
} 