<?php
/**
 * Created by PhpStorm.
 * User: Ernestas
 * Date: 2015-04-14
 * Time: 11:18
 */

namespace InfoGoal\KickerBundle\Model;

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

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @param array $options
     * @return Response
     */
    public function analyze($options)
    {
        $this->setOptions($options);

        // data from database
        $tableOptions = $this->options;

        $gameIsStarted = $tableOptions['table_state'] == 1 ? true : false;
        $gameTimeOut = $tableOptions['last_event_time'] > strtotime('-5 minutes', strtotime('now')) ? true : false;
        $unreadEvents = sizeof($this->data) > 0;

        if ($unreadEvents) {

        } else {

        }

        return new Response(print_r($this->options, true));
    }

    /**
     * @param array $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @param array $data
     */
    public function saveData($data)
    {
    }
} 