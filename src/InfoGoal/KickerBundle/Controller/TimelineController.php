<?php
/**
 * Created by PhpStorm.
 * User: Aurelija
 * Date: 2015-05-03
 * Time: 17:16
 */

namespace InfoGoal\KickerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class TimelineController extends Controller {

    public function indexAction()
    {
        $gameId = $this->getDoctrine()->getRepository('InfoGoalKickerBundle:TableOption')->findOneBy(array("optionKey" => "active_game_id"));
        $game = $this->getDoctrine()->getRepository('InfoGoalKickerBundle:Game')->findOneBy(array("id" => $gameId->getOptionValue()));
        return $this->render('InfoGoalKickerBundle:Timeline:index.html.twig', array( 'game' => $game ));
    }

}