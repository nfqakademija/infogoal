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
        return $this->render('InfoGoalKickerBundle:Timeline:index.html.twig', array(

        ));
    }

}