<?php

namespace InfoGoal\KickerBundle\Entity;

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
     * @var integer
     */
    private $player1;

    /**
     * @var integer
     */
    private $player2;

    /**
     * @var integer
     */
    private $player3;

    /**
     * @var integer
     */
    private $player4;

    /**
     * @var integer
     */
    private $goal1;

    /**
     * @var integer
     */
    private $goal2;


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
     * @param integer $player1
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
     * @return integer 
     */
    public function getPlayer1()
    {
        return $this->player1;
    }

    /**
     * Set player2
     *
     * @param integer $player2
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
     * @return integer 
     */
    public function getPlayer2()
    {
        return $this->player2;
    }

    /**
     * Set player3
     *
     * @param integer $player3
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
     * @return integer 
     */
    public function getPlayer3()
    {
        return $this->player3;
    }

    /**
     * Set player4
     *
     * @param integer $player4
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
     * @return integer 
     */
    public function getPlayer4()
    {
        return $this->player4;
    }

    /**
     * Set goal1
     *
     * @param integer $goal1
     * @return Game
     */
    public function setGoal1($goal1)
    {
        $this->goal1 = $goal1;

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
     * @param integer $goal2
     * @return Game
     */
    public function setGoal2($goal2)
    {
        $this->goal2 = $goal2;

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
}
