<?php
/**
 * Created by PhpStorm.
 * User: Ernestas
 * Date: 2015-04-14
 * Time: 09:45
 */

namespace InfoGoal\KickerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use InfoGoal\KickerBundle\Service\Api;


class ApiController extends Controller
{

    public function indexAction()
    {
        $api = $this->get('kicker.api');
        $em = $this->getDoctrine()->getManager();
        $options = $em->getRepository('InfoGoalKickerBundle:TableOption')->findAll();
        return $api->readApi($options);
    }
} 