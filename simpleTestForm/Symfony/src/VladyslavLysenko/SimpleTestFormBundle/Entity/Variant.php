<?php

namespace VladyslavLysenko\SimpleTestFormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Variant
 */
class Variant
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
     * @var integer
     */
    private $quantityOfPoints;

    /**
     * @return int
     */
    public function getQuantityOfPoints()
    {
        return $this->quantityOfPoints;
    }

    /**
     * @param int $qantityOfPoints
     */
    public function setQuantityOfPoints($qantityOfPoints)
    {
        $this->quantityOfPoints = $qantityOfPoints;
    }

    /**
     * @var Question
     */
    private $question;

    /**
     * @return Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param Question $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
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

    public function __construct( Question $question)
    {
       $this->question = $question;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Variant
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function __toString()
    {
        return $this->getDescription();
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
}
