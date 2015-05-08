<?php

namespace InfoGoal\KickerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlayersBadges
 */
class PlayersBadges
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $playerId;

    /**
     * @var integer
     */
    private $badgeId;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var ArrayCollection
     */
    protected $badges;

    /**
     * @var ArrayCollection
     */
    protected $players;

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
     * Set playerId
     *
     * @param integer $playerId
     * @return PlayersBadges
     */
    public function setPlayerId($playerId)
    {
        $this->playerId = $playerId;

        return $this;
    }

    /**
     * Get playerId
     *
     * @return integer 
     */
    public function getPlayerId()
    {
        return $this->playerId;
    }

    /**
     * Set badgeId
     *
     * @param integer $badgeId
     * @return PlayersBadges
     */
    public function setBadgeId($badgeId)
    {
        $this->badgeId = $badgeId;

        return $this;
    }

    /**
     * Get badgeId
     *
     * @return integer 
     */
    public function getBadgeId()
    {
        return $this->badgeId;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return PlayersBadges
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }
}
