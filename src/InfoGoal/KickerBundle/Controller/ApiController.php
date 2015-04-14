<?php
/**
 * Created by PhpStorm.
 * User: Ernestas
 * Date: 2015-04-14
 * Time: 09:45
 */

namespace InfoGoal\KickerBundle\Controller;

use InfoGoal\KickerBundle\Model\Api;


class ApiController {

    public function indexAction()
    {
        $api = new Api();
        return $api->readApi();
    }
} 