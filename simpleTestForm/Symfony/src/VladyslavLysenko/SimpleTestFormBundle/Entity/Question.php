<?php

namespace VladyslavLysenko\SimpleTestFormBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 */
class Question
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $type;

    /**
     * @var integer
     */
    private $quantityOfAnswers;

    /**
     * @var integer
     */
    private $mark;

    /**
     * @return ArrayCollection
     */
    public function getVariants()
    {
        return $this->variants;
    }

    /**
     * @param ArrayCollection $variants
     */
    public function setVariants($variants)
    {
        $this->variants = $variants;
    }
    /**
     * @var ArrayCollection
     */
    private $variants;

    /**
     * @return Test
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * @param Test $test
     */
    public function setTest($test)
    {
        $this->test = $test;
    }
    /**
     * @var Test
     */
    private $test;

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
     * Set description
     *
     * @param string $description
     * @return Question
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    function __construct()
    {
        $this->variants = new ArrayCollection();
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Question
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set quantityOfAnswers
     *
     * @param integer $quantityOfAnswers
     * @return Question
     */
    public function setQuantityOfAnswers($quantityOfAnswers)
    {
        $this->quantityOfAnswers = $quantityOfAnswers;

        return $this;
    }

    /**
     * Get quantityOfAnswers
     *
     * @return integer
     */
    public function getQuantityOfAnswers()
    {
        return $this->quantityOfAnswers;
    }

    /**
     * Set mark
     *
     * @param integer $mark
     * @return Question
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

    public function __toString()
    {
        return $this->getDescription();
    }
}
