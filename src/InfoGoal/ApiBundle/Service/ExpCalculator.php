<?php
namespace InfoGoal\ApiBundle\Service;

use InfoGoal\KickerBundle\Entity\Player;
use InfoGoal\KickerBundle\Entity\Game;
use Symfony\Component\Validator\Constraints\Null;


class ExpCalculator
{
    /**
     * @var EntityManager
     */
    private $em;


    function __construct($em)
    {
        $this->em = $em;
    }

    public function CalculateGoal($players)
    {
        foreach ($players as $player) {
            if ($player != null) {

                $player->setXp($player->getXp() + 301);

                $this->levelUp($player);

                $this->em->persist($player);
            }
        }
        $this->em->flush();
    }

    public function CalculateGame($game)
    {
        $timeEnd = $game->getDateEnd()->getTimestamp();
        $timeStart = $game->getDateStart()->getTimestamp();
        $exp = ceil(($timeEnd - $timeStart) / 60) * 5 + 50;
        $players = [];
        if ($game->getGoal1() > $game->getGoal2()) {
            array_push($players, $game->getPlayer1(), $game->getPlayer2(),
                $game->getPlayer3(), $game->getPlayer4());
        } else {
            array_push($players, $game->getPlayer4(), $game->getPlayer3(),
                $game->getPlayer2(), $game->getPlayer1());
        }
        for ($i = 0; $i < 2; $i++) {
            if ($players[$i] != null) {

                $players[$i]->setXp($players[$i]->getXp() + $exp + 50);

                $players[$i]->setPlayed($players[$i]->getPlayed() + 1);

                $players[$i]->setWon($players[$i]->getWon() + 1);

                $players[$i]->setLastGame($game->getDateEnd());

                $this->levelUp($players[$i]);

                $this->em->persist($players[$i]);
            }
        }

        for ($i = 2; $i < 4; $i++) {
            if ($players[$i] != null) {

                $players[$i]->setXp($players[$i]->getXp() + $exp);

                $players[$i]->setPlayed($players[$i]->getPlayed() + 1);

                $players[$i]->setLastGame($game->getDateEnd());

                $this->levelUp($players[$i]);

                $this->em->persist($players[$i]);
            }
        }

        $this->em->flush();

    }

    private function levelUp($player)
    {
        while ($player->getXp() >= $player->getLevelXp()) {

            $player->setXp($player->getXp() - $player->getLevelXp());

            $player->setLevel($player->getLevel() + 1);

            $player->setLevelXp(ceil(pow($player->getLevel(),(3/2)))/0.02);

            $this->em->persist($player);

        }
        $this->em->flush();
    }
} 