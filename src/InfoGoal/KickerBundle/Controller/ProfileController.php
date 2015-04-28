<?php

namespace InfoGoal\KickerBundle\Controller;

use InfoGoal\KickerBundle\Service\ExpCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfileController extends Controller
{
    public function indexAction()
    {
        $em =  $em = $this->getDoctrine()->getManager();
        $calculate = new ExpCalculator($em);

        $calculate->Calculate(1,10,True,10);

        $player = $this->getDoctrine()->getRepository('InfoGoalKickerBundle:Player')->find(1);

        return $this->render('InfoGoalKickerBundle:Profile:index.html.twig', array(
            'player' => $player
        ));
//        $player = new Player();
//        $player->setId(1);
//        $player->setCardId(0004255210);
//        $player->setName("Albertas Balzarevicius");
//          $player->setXp(0);
//          $player->
//        $em = $this->getDoctrine()->getManager();
//        $em->persist($player);
//        $em->flush();
    }

}
