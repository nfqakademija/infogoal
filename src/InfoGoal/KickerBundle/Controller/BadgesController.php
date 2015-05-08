<?php
/**
 * Created by PhpStorm.
 * User: Aurelija
 * Date: 2015-05-08
 * Time: 23:13
 */

namespace InfoGoal\KickerBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BadgesController  extends Controller{

    public function indexAction($page = 1)
    {
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $games = $this->getDoctrine()->getRepository('InfoGoalKickerBundle:Badge')
            ->createQueryBuilder('u')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->getQuery()
            ->getResult();
        return $this->render('InfoGoalKickerBundle:Badges:index.html.twig', array( 'games' => $games ));
    }
}