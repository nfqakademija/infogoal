<?php
namespace InfoGoal\ApiBundle\Service;

use InfoGoal\KickerBundle\Player;
use InfoGoal\KickerBundle\Game;


class ExpCalculator {
    private $em;



    function __construct($em)
    {
       $this->em = $em;
    }

    public function CalculateGoal($cardIds)
    {
        foreach($cardIds as $cardId) {
            $player = $this->em->getRepository('InfoGoalKickerBundle:Player')->find($cardId);

            $player->setXp($player->getXp() + 50);

            levelUp($player);
        }
    }

    public function CalculateGame($game)
    {

        $exp = ($game->getDateEnd() - $game->getDateStart()) * 5 + 50;
        echo $exp;
        return;
        $cardIds = [];
        array_push($cardIds, $game->getPlayer1(), $game->getPlayer2(), $game->getPlayer3(), $game->getPlayer4());

//        if($game->)

        foreach ($cardIds as $cardId) {
            $player = $this->em->getRepository('InfoGoalKickerBundle:Player')->find($cardId);

            $player->setXp($player->getXp() + $exp);

            levelUp($player);
        }

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