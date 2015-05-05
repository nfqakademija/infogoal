<?php
namespace InfoGoal\ApiBundle\Service;

use InfoGoal\KickerBundle\Entity\Player;
use InfoGoal\KickerBundle\Entity\Game;
use Symfony\Component\Validator\Constraints\Null;


class ExpCalculator
{
    private $em;


    function __construct($em)
    {
        $this->em = $em;
    }

    public function CalculateGoal($cardIds)
    {
        foreach ($cardIds as $cardId) {
            if ($cardId != null) {
                $player = $this->em->getRepository('InfoGoalKickerBundle:Player')->find($cardId);
                if ($player != null) {
                    $player->setXp($player->getXp() + 10);

                    levelUp($player);

                    $this->em->flush();
                }
            }
        }
    }

    public function CalculateGame($game)
    {
        $timeEnd = $game->getDateEnd()->getTimestamp();
        $timeStart = $game->getDateStart()->getTimestamp();
        $exp = ceil(($timeEnd - $timeStart)/60) * 5 + 50;
        echo  "exp".$exp;
        $cardIds = [];
        if ($game->getGoal1() > $game->getGoal2()) {
            array_push($cardIds, $game->getPlayer1(), $game->getPlayer2(), $game->getPlayer3(), $game->getPlayer4());
        }
        else{
            array_push($cardIds, $game->getPlayer4(), $game->getPlayer3(), $game->getPlayer2(), $game->getPlayer1());
        }
        for ($i = 0; $i < 2; $i++){
            if($cardIds[$i] != null) {
                $player = $this->em->getRepository('InfoGoalKickerBundle:Player')->find($cardIds[$i]);
                if ($player != null) {
                    $player->setXp($player->getXp() + $exp + 50);

                    $player->setPlayed($player->getPlayed() + 1);

                    $player->setWon($player->getWon() + 1);

                $player->setLastGame($game->getDateEnd);
            }

                $this->levelUp($player);
            }
        }

        for ($i = 2; $i < 4; $i++) {
            if ($cardIds[$i] != null) {
                $player = $this->em->getRepository('InfoGoalKickerBundle:Player')->find($cardIds[$i]);
                if ($player != null) {
                    $player->setXp($player->getXp() + $exp);

                    $player->setPlayed($player->getPlayed() + 1);

                    $player->setLastGame($game->getDateEnd);
                }

                $this->levelUp($player);
            }
        }

        $this->em->flush();

    }

    private function levelUp($player)
    {
        if($player != null) {
            if ($player->getXp() >= $player->getLevelXp()) {
                $player->setLevel($player->getLevel() + 1);
                $player->setLevelXp($player->getLevelXp() * 1.5);
            }
        }
    }
} 