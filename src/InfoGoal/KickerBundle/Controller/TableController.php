<?php

namespace InfoGoal\KickerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TableController extends Controller
{
        public function indexAction()
    {
        $status = $this->getDoctrine()->getRepository('InfoGoalKickerBundle:TableOption')->findOneBy(array("optionKey" => "table_status"));
        if($status){
            return $this->render('InfoGoalKickerBundle:Table:index.html.twig', array( ));
        } else {
            return $this->render('InfoGoalKickerBundle:Table:game.html.twig', array( ));
        }

    }
    public function reservationAction()
    {
        return $this->render('InfoGoalKickerBundle:Table:reservation.html.twig', array(

        ));
    }
}
