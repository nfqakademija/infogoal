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
     * @var EntityManager
     */
    private $em;

    /**
     * @var array
     */
    private $options;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param array $options
     * @return Response
     */
    public function analyze($data, $options)
    {
        if (!isset($options['table_state'])) {
            $options['table_state'] = 1;
        }

        if (!isset($options['last_event_time'])) {
            $options['last_event_time'] = strtotime('now');
        }

        $this->data = $data;
        $this->options = $options;

        $gameIsStarted = $options['table_state'] == 1 ? true : false;
        $gameTimeOut = $options['last_event_time'] > strtotime('-5 minutes', strtotime('now')) ? true : false;
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