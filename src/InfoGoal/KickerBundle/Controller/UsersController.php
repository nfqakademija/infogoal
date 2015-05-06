<?php
/**
 * Created by PhpStorm.
 * User: Aurelija
 * Date: 2015-04-27
 * Time: 19:45
 */

namespace InfoGoal\KickerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UsersController extends Controller {

    public function indexAction()
    {
        return $this->render('InfoGoalKickerBundle:Users:index.html.twig', array(

        ));
    }
}