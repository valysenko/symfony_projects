<?php

namespace LysenkoVA\Bundle\ServiceCenterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
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
     * @Assert\Range(min = "1", minMessage = "Price should be greater then 0.")
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @return Contract
     */
    public function getContract()
    {
        return $this->contract;
    }

    /**
     * @param Contract $contract
     */
    public function setContract($contract)
    {
        $this->contract = $contract;
    }

    /**
     * @var Contract
     * @ORM\ManyToOne(targetEntity="LysenkoVA\Bundle\ServiceCenterBundle\Entity\Contract",inversedBy="madeServices")
     *
     */
    private $contract;


    /**
     * @var string
     * @ORM\Column(name="comment", nullable=true, type="string",length=120)
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
