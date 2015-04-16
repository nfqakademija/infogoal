<?php

namespace InfoGoal\KickerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TableController extends Controller
{
    public function indexAction()
    {
        return $this->render('InfoGoalKickerBundle:Table:index.html.twig', array(
                // ...
            ));    }
    public function reservationAction()
    {
        return $this->render('InfoGoalKickerBundle:Table:reservation.html.twig', array(

        ));
    }
}
