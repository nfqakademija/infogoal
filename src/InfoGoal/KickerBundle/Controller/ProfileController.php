<?php

namespace InfoGoal\KickerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfileController extends Controller
{
    public function indexAction($id)
    {

       $player = $this->getDoctrine()->getRepository('InfoGoalKickerBundle:Player')->findOneBy(array("id" => $id));

        return $this->render('InfoGoalKickerBundle:Profile:index.html.twig', array(
            'player' => $player
        ));
    }

}
