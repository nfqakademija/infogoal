<?php
/**
 * Created by PhpStorm.
 * User: Aurelija
 * Date: 2015-05-03
 * Time: 17:16
 */

namespace InfoGoal\KickerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints\Null;


class TimelineController extends Controller {

    public function indexAction($page = 1)
    {
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $games = $this->getDoctrine()->getRepository('InfoGoalKickerBundle:Game')
            ->createQueryBuilder('u')
            ->where('u.dateEnd IS NOT NULL')
            ->orderBy('u.dateEnd', 'DESC')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->getQuery()
            ->getResult();
        return $this->render('InfoGoalKickerBundle:Timeline:index.html.twig', array( 'games' => $games ));
    }

}