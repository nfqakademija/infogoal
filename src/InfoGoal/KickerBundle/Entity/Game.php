<?php

namespace InfoGoal\KickerBundle\Entity;

use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 */
class Game
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $dateStart;

    /**
     * @var \DateTime
     */
    private $dateEnd;

    /**
     * @var Player
     */
    private $player1;

    /**
     * @var Player
     */
    private $player2;

    /**
     * @var Player
     */
    private $player3;

    /**
     * @var Player
     */
    private $player4;

    /**
     * @var integer
     */
    private $goal1 = 0;

    /**
     * @var integer
     */
    private $goal2 = 0;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateStart
     *
     * @param \DateTime $dateStart
     * @return Game
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     * @return Game
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set player1
     *
     * @param Player $player1
     * @return Game
     */
    public function setPlayer1($player1)
    {
        $this->player1 = $player1;

        return $this;
    }

    /**
     * Get player1
     *
     * @return Player
     */
    public function getPlayer1()
    {
        return $this->player1;
    }

    /**
     * Set player2
     *
     * @param Player $player2
     * @return Game
     */
    public function setPlayer2($player2)
    {
        $this->player2 = $player2;

        return $this;
    }

    /**
     * Get player2
     *
     * @return Player
     */
    public function getPlayer2()
    {
        return $this->player2;
    }

    /**
     * Set player3
     *
     * @param Player $player3
     * @return Game
     */
    public function setPlayer3($player3)
    {
        $this->player3 = $player3;

        return $this;
    }

    /**
     * Get player3
     *
     * @return Player
     */
    public function getPlayer3()
    {
        return $this->player3;
    }

    /**
     * Set player4
     *
     * @param Player $player4
     * @return Game
     */
    public function setPlayer4($player4)
    {
        $this->player4 = $player4;

        return $this;
    }

    /**
     * Get player4
     *
     * @return Player
     */
    public function getPlayer4()
    {
        return $this->player4;
    }

    /**
     * Set goal1
     *
     * @return Game
     */
    public function setGoal1()
    {
        $this->goal1++;

        return $this;
    }

    /**
     * Get goal1
     *
     * @return integer
     */
    public function getGoal1()
    {
        return $this->goal1;
    }

    /**
     * Set goal2
     *
     * @return Game
     */
    public function setGoal2()
    {
        $this->goal2++;

        return $this;
    }

    /**
     * Get goal2
     *
     * @return integer
     */
    public function getGoal2()
    {
        return $this->goal2;
    }

    /**
     * @return array
     */
    public function getAllPlayersIds()
    {
        $players = [];
        if (!is_null($this->player1)) {
            array_push($players, $this->player1->getId());
        }
        if (!is_null($this->player2)) {
            array_push($players, $this->player2->getId());
        }
        if (!is_null($this->player3)) {
            array_push($players, $this->player3->getId());
        }
        if (!is_null($this->player4)) {
            array_push($players, $this->player4->getId());
        }
        return $players;
    }

    public function getDateDiff() {
        $dateEnd = $this->getDateEnd();
        if (is_null($dateEnd)) {
            return 'NaN';
        }
        Carbon::setLocale('lt');
        $cDate = Carbon::instance($dateEnd);
        $diff = $cDate->diffForHumans(Carbon::now()->addMinutes(2));
        $diff = str_replace(array('metai', 'metų'), 'm.', $diff);
        $diff = str_replace(array('mėnuo', 'mėnesiai', 'mėnesių'), 'mėn.', $diff);
        $diff = str_replace(array('savaitė', 'savaitės', 'savaičių'), 'sav.', $diff);
        $diff = str_replace(array('diena', 'dienos', 'dienų'), 'd.', $diff);
        $diff = str_replace(array('valanda', 'valandos', 'valandų'), 'val.', $diff);
        $diff = str_replace(array('minutės', 'minutė', 'minučių'), 'min.', $diff);
        $diff = str_replace(array('sekundės', 'sekundė', 'sekundžių'), 's.', $diff);
        return $diff;
    }
}
