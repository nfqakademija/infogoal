<?php

namespace InfoGoal\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use InfoGoal\ApiBundle\Service\Api;
use InfoGoal\ApiBundle\Service\Achievements;


class ApiController extends Controller
{

    public function indexAction()
    {
//        $api = $this->get('kicker.api');
        $em = $this->getDoctrine()->getManager();
//        $options = $em->getRepository('InfoGoalKickerBundle:TableOption')->findAll();
//        return $api->readApi($options);
        $badge = new Achievements($em);

        $player = $em->getRepository('InfoGoalKickerBundle:Player')->find(7);

        $badge->checkBadges($player);

        return $this->render('InfoGoalKickerBundle:Profile:index.html.twig', array(
            'player' => $player
        ));

    }
} 