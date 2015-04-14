<?php
/**
 * Created by PhpStorm.
 * User: Ernestas
 * Date: 2015-04-14
 * Time: 11:18
 */

namespace InfoGoal\KickerBundle\Model;

use Symfony\Component\HttpFoundation\Response;

class DataAnalyzer
{
    /**
     * @var array
     */
    private $data = [];

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return Response
     */
    public function analyze()
    {
        // data analyze
        return new Response(print_r($this->data, true));
    }

    /**
     * @param $data
     */
    public function saveData($data)
    {
        // save/update data to database
    }
} 