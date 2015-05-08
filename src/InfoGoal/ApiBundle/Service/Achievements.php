<?php

namespace InfoGoal\ApiBundle\Service;


use Symfony\Component\BrowserKit\Response;
use InfoGoal\KickerBundle\Entity\Badge;
use InfoGoal\KickerBundle\Entity\Player;
use InfoGoal\KickerBundle\Entity\PlayersBadges;
use DateTime;

class Achievements
{
    private $em;

    function __construct($em)
    {
        $this->em = $em;
    }


    public function checkBadges($player)
    {
        $badges = $this->em->getRepository('InfoGoalKickerBundle:Badge')->findAll();

        $playerInfo = array();

//        var_dump($badges);

        $playerInfo['win'] = $player->getWon();

        $playerInfo['played'] = $player->getPlayed();

        foreach ($badges as $badge) {
            $rule = explode('::', $badge->getRulesToGetBadge());
//isset($playerInfo[$rule[0]]) &&
            if ($playerInfo[$rule[0]] >= $rule[1]) {

                echo $rule[0]."<br>";
                echo $playerInfo[$rule[0]]." ".$rule[1]."<br>";

                $playerBadge = new PlayersBadges();

                echo $player->getId()." ".$badge->getId()."<br>";

                $playerBadge->setPlayerId($player->getId());
                $playerBadge->setBadgeId($badge->getId());

                $date = new DateTime();
                $date->getTimestamp();
                $playerBadge->setDate($date);

                echo $playerBadge->getPlayerId()." ";
                echo $playerBadge->getBadgeId()."<br>";

                $this->em->persist($playerBadge);
                $this->em->flush();
            }
        }

    }
} 