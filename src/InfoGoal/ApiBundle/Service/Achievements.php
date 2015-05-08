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
        array_push($players, $game->getPlayer1(), $game->getPlayer2(),
            $game->getPlayer3(), $game->getPlayer4());

        $badges = $this->em->getRepository('InfoGoalKickerBundle:Badge')->findAll();
        foreach ($players as $player) {
            if ($player != null) {
                $playerInfo = array();

                $playerInfo['win'] = $player->getWon();

                $playerInfo['played'] = $player->getPlayed();

                foreach ($badges as $badge) {
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
} 