<?php

namespace InfoGoal\KickerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TableController extends Controller
{
        public function indexAction()
    {
        $state = $this->getDoctrine()->getRepository('InfoGoalKickerBundle:TableOption')->findOneBy(array("optionKey" => "table_state"));
        $stateValue = $state->getOptionValue();
        if($stateValue == 0){
            return $this->render('InfoGoalKickerBundle:Table:index.html.twig', array( ));
        } elseif($stateValue == 1) {
            $gameId = $this->getDoctrine()->getRepository('InfoGoalKickerBundle:TableOption')->findOneBy(array("optionKey" => "active_game_id"));
            $game = $this->getDoctrine()->getRepository('InfoGoalKickerBundle:Game')->findOneBy(array("id" => $gameId->getOptionValue()));

            return $this->render('InfoGoalKickerBundle:Table:game.html.twig', array('game' => $game));
        } else {
            return $this->render('@InfoGoalKicker/Table/reservation.html.twig');
        }

    }
    public function reservationAction()
    {
        return $this->render('InfoGoalKickerBundle:Table:reservation.html.twig', array(

        ));
    }
}
