<?php

namespace InfoGoal\KickerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TableOption
 */
class TableOption
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $optionKey;

    /**
     * @var string
     */
    private $optionValue;


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
     * Set optionKey
     *
     * @param string $optionKey
     * @return TableOption
     */
    public function setOptionKey($optionKey)
    {
        $this->optionKey = $optionKey;

        return $this;
    }

    /**
     * Get optionKey
     *
     * @return string 
     */
    public function getOptionKey()
    {
        return $this->optionKey;
    }

    /**
     * Set optionValue
     *
     * @param string $optionValue
     * @return TableOption
     */
    public function setOptionValue($optionValue)
    {
        $this->optionValue = $optionValue;

        return $this;
    }

    /**
     * Get optionValue
     *
     * @return string 
     */
    public function getOptionValue()
    {
        return $this->optionValue;
    }
}
