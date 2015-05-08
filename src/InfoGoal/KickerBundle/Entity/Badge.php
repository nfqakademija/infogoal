<?php

namespace InfoGoal\KickerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Badge
 */
class Badge
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $rulesToGetBadge;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $imageUrl;

    /**
     * @var ArrayCollection
     */
    protected $BP;

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
     * Set rulesToGetBadge
     *
     * @param string $rulesToGetBadge
     * @return Badge
     */
    public function setRulesToGetBadge($rulesToGetBadge)
    {
        $this->rulesToGetBadge = $rulesToGetBadge;

        return $this;
    }

    /**
     * Get rulesToGetBadge
     *
     * @return string 
     */
    public function getRulesToGetBadge()
    {
        return $this->rulesToGetBadge;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Badge
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
     * Set imageUrl
     *
     * @param string $imageUrl
     * @return Badge
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * Get imageUrl
     *
     * @return string 
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }
}
