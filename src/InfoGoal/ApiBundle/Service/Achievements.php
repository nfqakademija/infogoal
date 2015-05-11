<?php

namespace InfoGoal\ApiBundle\Service;


use Symfony\Component\BrowserKit\Response;
use InfoGoal\KickerBundle\Entity\Badge;
use InfoGoal\KickerBundle\Entity\Player;
use InfoGoal\KickerBundle\Entity\PlayersBadges;
use DateTime;

class Achievements
{
    /**
     * @var EntityManager
     */
    private $em;

    function __construct($em)
    {
        $this->em = $em;
    }


    public function checkBadges($game)
    {
        $players = array();

        array_push($players, $game->getPlayer1(), $game->getPlayer2());
        array_push($players, $game->getPlayer3(), $game->getPlayer4());

        $badges = $this->em->getRepository('InfoGoalKickerBundle:Badge')->findAll();
        foreach ($players as $player) {
            foreach ($badges as $badge) {
                if ($player != null) {
                    $playerInfo = array();

                    $playerInfo['win'] = $player->getWon();

                    $playerInfo['played'] = $player->getPlayed();

                    $playerInfo['goals'] = $this->countGoals($player);

                        $rule = explode('::', $badge->getRulesToGetBadge());
                        if ($playerInfo[$rule[0]] >= $rule[1]) {
                            $this->getBadge($player, $badge);
                    }
                }
            }
        }
    }

    private function getBadge($player, $badge)
    {
        $playerBadgeDup = $this->em->getRepository('InfoGoalKickerBundle:PlayersBadges')->findOneBy(
            array('players' => $player, 'badges' => $badge)
        );
        if (!isset($playerBadgeDup)) {
            $playerBadge = new PlayersBadges();

            $playerBadge->setPlayers($player);
            $playerBadge->setBadges($badge);

            $date = new DateTime();
            $date->getTimestamp();
            $playerBadge->setDate($date);

            $this->em->persist($playerBadge);
            $this->em->flush();
        }
    }


    public function countGoals($player){
        $goals = 0;
        $games1 = $this->em->getRepository('InfoGoalKickerBundle:Game')
            ->createQueryBuilder('p')
            ->where('p.player1 = :player')
            ->orWhere('p.player2 = :player')
            ->setParameter('player', $player)
            ->orderBy('p.dateEnd', 'DESC')
            ->getQuery()->getResult();

        $games2 = $this->em->getRepository('InfoGoalKickerBundle:Game')
            ->createQueryBuilder('p')
            ->where('p.player3 = :player')
            ->orWhere('p.player4 = :player')
            ->setParameter('player', $player)
            ->orderBy('p.dateEnd', 'DESC')
            ->getQuery()->getResult();

        foreach ($games1 as $game1){
            $goals += $game1->getGoal1();
        }

        foreach ($games2 as $game2){
            $goals += $game2->getGoal2();
        }

        return $goals;
    }
} 