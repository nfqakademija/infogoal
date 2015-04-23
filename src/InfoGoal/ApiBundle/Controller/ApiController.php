<?php

namespace InfoGoal\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use InfoGoal\ApiBundle\Service\Api;


class ApiController extends Controller
{

    public function indexAction()
    {
        $api = $this->get('kicker.api');
        $em = $this->getDoctrine()->getManager();
        $options = $em->getRepository('InfoGoalKickerBundle:TableOption')->findAll();
        return $api->readApi($options);
    }
} 