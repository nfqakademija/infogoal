<?php

namespace InfoGoal\KickerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfileController extends Controller
{
    public function indexAction()
    {


        return $this->render('InfoGoalKickerBundle:Profile:index.html.twig', array(
        ));
    }

}
