<?php
namespace InfoGoal\KickerBundle\Service;

use InfoGoal\KickerBundle\Player;

class ExpCalculator {
    public function Calculate($time, $win, $goals ){
        $exp = $time*5 + $goals*10 + 50;

        if ($win === true)
            $this->$exp = + 50;

        $player = new Player();

        //...



    }
} 