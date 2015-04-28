<?php
namespace InfoGoal\KickerBundle\Service;

use InfoGoal\KickerBundle\Player;


class ExpCalculator {
    private $em;

    function __construct($em)
    {
        $this->em = $em;
    }

    public function Calculate($id, $time, $win, $goals ){
        $exp = $time*5 + $goals*10 + 50;

        if ($win === true)
            $this->$exp = + 50;

//        $this->em = $this->getDoctrine()->getManager();

        $player = $this->em->getRepository('InfoGoalKickerBundle:Player')->find($id);

        $player->setXp($player->getXp() + $exp);

        if ($player->getXp() >= $player->getLevelXp() )
        {
            $player->setLevel($player->getLevel() + 1);
            $player->setLevelXp($player->getLevelXp()*1.5);
        }
        $this->em->persist($player);
        $this->em->flush();

    }
} 