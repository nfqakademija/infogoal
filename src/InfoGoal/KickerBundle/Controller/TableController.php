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
            return $this->render('InfoGoalKickerBundle:Table:index.html.twig', array());
        } elseif($stateValue == 1) {
            $gameId = $this->getDoctrine()->getRepository('InfoGoalKickerBundle:TableOption')->findOneBy(array("optionKey" => "active_game_id"));
            $game = $this->getDoctrine()->getRepository('InfoGoalKickerBundle:Game')->findOneBy(array("id" => $gameId->getOptionValue()));
            if ($game->getGoal1() != 10 and $game->getGoal2() != 10) {
                return $this->render('InfoGoalKickerBundle:Table:game.html.twig', array('game' => $game));
            } else {
                if ($game->getGoal1() == 10) {
                    return $this->render('InfoGoalKickerBundle:Table:result.html.twig', array('player1' => $game->getPlayer1(), 'player2' => $game->getPlayer2()));
                } else {
                    return $this->render('InfoGoalKickerBundle:Table:result.html.twig', array('player1' => $game->getPlayer3(), 'player2' => $game->getPlayer4()));
                }
            }
        } else {
            $reservationTime = $this->getDoctrine()->getRepository('InfoGoalKickerBundle:TableOption')->findOneBy(array("optionKey" => "reservation_until"));
            $reservationTimeValue = $reservationTime->getOptionValue();
            $timeNow = time();

            $diff = $reservationTimeValue - $timeNow;

            $secs = $diff%60;
            $mins = floor($diff/60);

            return $this->render('@InfoGoalKicker/Table/reservation.html.twig', array('mins' => $mins, 'secs' => $secs));
        }

    }
    public function reservationAction()
    {
        return $this->render('InfoGoalKickerBundle:Table:reservation.html.twig', array(

        ));
    }
}
