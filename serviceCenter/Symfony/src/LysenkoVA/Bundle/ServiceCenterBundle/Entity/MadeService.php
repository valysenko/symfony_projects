<?php

namespace LysenkoVA\Bundle\ServiceCenterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MadeService
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class MadeService
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=20)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @return Act
     */
    public function getAct()
    {
        return $this->act;
    }

    /**
     * @param Act $act
     */
    public function setAct($act)
    {
        $this->act = $act;
    }

    /**
     * @var Act
     * @ORM\ManyToOne(targetEntity="LysenkoVA\Bundle\ServiceCenterBundle\Entity\Act",inversedBy="madeServices")
     */
    private $act;

    /**
     * @var string
     */
    private $comment;

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
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
     * Set name
     *
     * @param string $name
     * @return MadeService
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
     * Set price
     *
     * @param float $price
     * @return MadeService
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }
}
