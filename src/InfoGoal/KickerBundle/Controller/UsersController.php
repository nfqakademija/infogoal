<?php
/**
 * Created by PhpStorm.
 * User: Aurelija
 * Date: 2015-04-27
 * Time: 19:45
 */

namespace InfoGoal\KickerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UsersController extends Controller {

    public function indexAction($page = 1, Request $request)
    {
        $orderHow = $request->query->get('how');
        $orderBy = $request->query->get('order');
        $search = $request->query->get('search');


        $orderByVariants = array('name', 'level', 'played', 'won', 'lastGame');

        if (!in_array($orderBy, $orderByVariants)) {
            $orderBy = 'lastGame';
        }

        if ($orderHow != 'asc' && $orderHow != 'desc') {
            $orderHow = 'desc';
        }

        $limit = 10;
        $offset = ($page - 1) * $limit;
        $users = $this->getDoctrine()->getRepository('InfoGoalKickerBundle:Player')
            ->createQueryBuilder('u');
        if (!empty($search)) {
            $users->where($users->expr()->like('u.name', ':search'))
                ->setParameter('search', '%'.$search.'%');
        }
            $users->add('orderBy', 'u.'.$orderBy.' '.$orderHow)
            ->setMaxResults($limit)
            ->setFirstResult($offset);

        $searchResult = $users->getQuery()->getResult();
        return $this->render('InfoGoalKickerBundle:Users:index.html.twig', array( 'users' => $searchResult, 'orderHow' => $orderHow, 'orderBy' => $orderBy, 'searchPhrase' => $search ));
    }
}