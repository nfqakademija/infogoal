<?php

namespace InfoGoal\KickerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Player
 */
class Player
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $cardId = NULL;

    /**
     * @var string
     */
    private $name = NULL;

    /**
     * @var integer
     */
    private $xp = 0;

    /**
     * @var integer
     */
    private $levelXp = 1000;

    /**
     * @var integer
     */
    private $level = 1;
    /**
     * @var integer
     */
    private $played = 0;

    /**
     * @var integer
     */
    private $won = 0;

    /**
     * @var \DateTime
     */
    private $lastGame = NULL;

    /**
     * @var String
     */
    private $photo;

    /**
     * @return String
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param String $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

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
     * Set cardId
     *
     * @param integer $cardId
     * @return Player
     */
    public function setCardId($cardId)
    {
        $this->cardId = $cardId;

        return $this;
    }

    /**
     * Get cardId
     *
     * @return integer 
     */
    public function getCardId()
    {
        return $this->cardId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Player
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set xp
     *
     * @param integer $xp
     * @return Player
     */
    public function setXp($xp)
    {
        $this->xp = $xp;

        return $this;
    }

    /**
     * Get xp
     *
     * @return integer 
     */
    public function getXp()
    {
        return $this->xp;
    }

    /**
     * Set level
     *
     * @param integer $level
     * @return Player
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set won
     *
     * @param integer $won
     * @return Player
     */
    public function setWon($won)
    {
        $this->won = $won;

        return $this;
    }

    /**
     * Get won
     *
     * @return integer 
     */
    public function getWon()
    {
        return $this->won;
    }

    /**
     * Set lastGame
     *
     * @param \DateTime $lastGame
     * @return Player
     */
    public function setLastGame($lastGame)
    {
        $this->lastGame = $lastGame;

        return $this;
    }

    /**
     * Get lastGame
     *
     * @return \DateTime 
     */
    public function getLastGame()
    {
        return $this->lastGame;
    }

    /**
     * Set levelXp
     *
     * @param integer $levelXp
     * @return Player
     */
    public function setLevelXp($levelXp)
    {
        $this->levelXp = $levelXp;

        return $this;
    }

    /**
     * Get levelXp
     *
     * @return integer 
     */
    public function getLevelXp()
    {
        return $this->levelXp;
    }

    /**
     * Set played
     *
     * @param integer $played
     * @return Player
     */
    public function setPlayed($played)
    {
        $this->played = $played;

        return $this;
    }

    /**
     * Get played
     *
     * @return integer 
     */
    public function getPlayed()
    {
        return $this->played;
    }
}
