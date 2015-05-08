<?php

namespace InfoGoal\KickerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfileController extends Controller
{
    public function indexAction($id)
    {

        $player = $this->getDoctrine()->getRepository('InfoGoalKickerBundle:Player')->findOneBy(array("id" => $id));
        $badgesId = $this->getDoctrine()->getRepository('InfoGoalKickerBundle:PlayersBadges')->findBy(array("playerId" => $id));
        $badges = $this->getDoctrine()->getRepository('InfoGoalKickerBundle:Badge')->findBy(array("id" => $badgesId));
        $badgesCount = count($badges);
        return $this->render('InfoGoalKickerBundle:Profile:index.html.twig', array(
            'player' => $player,
            'badges' => $badges,
            'badgesCount' => $badgesCount
        ));
    }

}
