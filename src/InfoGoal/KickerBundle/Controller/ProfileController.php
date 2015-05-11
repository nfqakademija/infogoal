<?php

namespace InfoGoal\KickerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfileController extends Controller
{
    public function indexAction($id)
    {
        $limit = 6;
        $player = $this->getDoctrine()->getRepository('InfoGoalKickerBundle:Player')->findOneBy(array("id" => $id));
        $games = $this->getDoctrine()->getRepository('InfoGoalKickerBundle:Game')
            ->createQueryBuilder('p')
            ->where('p.player1 = :player')
            ->orWhere('p.player2 = :player')
            ->orWhere('p.player3 = :player')
            ->orWhere('p.player4 = :player')
            ->setParameter('player', $player)
            ->orderBy('p.dateEnd', 'DESC')
            ->getQuery()->getResult();
        $badges = $this->getDoctrine()->getRepository('InfoGoalKickerBundle:Badge')->findBy(array(), null, $limit);
        $playersBadges = $player->getPB();
        $badgesCount = count($playersBadges);

        return $this->render('InfoGoalKickerBundle:Profile:index.html.twig', array(
            'player' => $player,
            'playersBadges' => $playersBadges,
            'badgesCount' => $badgesCount,
            'badges' => $badges,
            'games' => $games
        ));
    }

}
