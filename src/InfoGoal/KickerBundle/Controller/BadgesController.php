<?php

namespace InfoGoal\KickerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BadgesController extends Controller
{

    public function indexAction($page = 1)
    {
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $badges = $this->getDoctrine()->getRepository('InfoGoalKickerBundle:Badge')
            ->createQueryBuilder('u')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->getQuery()
            ->getResult();
        return $this->render('InfoGoalKickerBundle:Badges:index.html.twig', array('badges' => $badges));
    }
}