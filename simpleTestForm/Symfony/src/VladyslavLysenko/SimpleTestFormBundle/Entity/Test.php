<?php

namespace VladyslavLysenko\SimpleTestFormBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Test
 */
class Test
{
    /**
     * @var integer
     */
    private $id;
    /**
     * @var integer
     */
    private $idUser;

    /**
     * @return int
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param int $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @var integer
     */
    private $isActive;
    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $maxMark;

    /**
     * @return ArrayCollection
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * @param ArrayCollection $questions
     */
    public function setQuestions($questions)
    {
        $this->questions = $questions;
    }

    /**
     * @var ArrayCollection
     *
     */
    private $questions;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }



    public function __toString()
    {
        return $this->getDescription();
    }


    /**
     * Set description
     *
     * @param string $description
     * @return Test
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

    /**
     * Set maxMark
     *
     * @param string $maxMark
     * @return Test
     */
    public function setMaxMark($maxMark)
    {
        $this->maxMark = $maxMark;

        return $this;
    }

    /**
     * Get maxMark
     *
     * @return string 
     */
    public function getMaxMark()
    {
        return $this->maxMark;
    }
}
