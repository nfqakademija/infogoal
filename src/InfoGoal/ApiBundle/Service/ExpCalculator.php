<?php
namespace InfoGoal\ApiBundle\Service;

use InfoGoal\KickerBundle\Player;


class ExpCalculator {
    private $em;


    function __construct($em)
    {
       $this->em = $em;
    }

    public function CalculateGoal($id)
    {
        $this->$player = $this->em->getRepository('InfoGoalKickerBundle:Player')->find($id);

        $player->setXp($player->getXp() + 50);

        levelUp($player);
    }

    public function CalculateGame($id, $time, $win){

        $exp = $time * 5 + 50;

        if ($win)
            $this->$exp = + 50;

        $this->em = $this->getDoctrine()->getManager();

        $player = $this->em->getRepository('InfoGoalKickerBundle:Player')->find($id);

        $player->setXp($player->getXp() + $exp);

        levelUp($player);

        $this->em->persist($player);
        $this->em->flush();

    }

    public function levelUp($player){
        if ($player->getXp() >= $player->getLevelXp() )
        {
            $player->setLevel($player->getLevel() + 1);
            $player->setLevelXp($player->getLevelXp()*1.5);
        }
    }
} 