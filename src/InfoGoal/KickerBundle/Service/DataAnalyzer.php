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
     * @var array
     */
    private $data = [];

    /**
     * @var array
     */
    private $options;

    /**
     * @param array $options
     * @return Response
     */
    public function analyze($data, $options)
    {
        $this->data = $data;
        $this->options = $options;

        // data from database
        $tableOptions = $this->options;

        if (!isset($tableOptions['table_state'])) {
            $tableOptions['table_state'] = 1;
        }

        if (!isset($tableOptions['last_event_time'])) {
            $tableOptions['last_event_time'] = strtotime('now');
        }

        $gameIsStarted = $tableOptions['table_state'] == 1 ? true : false;
        $gameTimeOut = $tableOptions['last_event_time'] > strtotime('-5 minutes', strtotime('now')) ? true : false;
        $unreadEvents = sizeof($this->data) > 0;

        if ($unreadEvents) {

        } else {

        }

        return new Response(print_r($this->options, true));
    }

    public function saveData()
    {

    }
} 