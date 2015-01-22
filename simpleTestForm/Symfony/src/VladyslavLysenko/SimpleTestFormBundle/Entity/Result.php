<?php

namespace VladyslavLysenko\SimpleTestFormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Result
 */
class Result
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $testId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $mark;

    /**
     * @var float
     */
    private $percents;

    /**
     * @return float
     */
    public function getPercents()
    {
        return $this->percents;
    }

    /**
     * @param float $percents
     */
    public function setPercents($percents)
    {
        $this->percents = $percents;
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
     * Set testId
     *
     * @param integer $testId
     * @return Result
     */
    public function setTestId($testId)
    {
        $this->testId = $testId;

        return $this;
    }

    /**
     * Get testId
     *
     * @return integer 
     */
    public function getTestId()
    {
        return $this->testId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Result
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
     * Set mark
     *
     * @param integer $mark
     * @return Result
     */
    public function setMark($mark)
    {
        $this->mark = $mark;

        return $this;
    }

    /**
     * Get mark
     *
     * @return integer 
     */
    public function getMark()
    {
        return $this->mark;
    }
}
