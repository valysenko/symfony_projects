<?php

namespace LysenkoVA\Bundle\ServiceCenterBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Act
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Act
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var float
     *
     * @ORM\Column(name="sum", type="float")
     */
    private $sum;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="LysenkoVA\Bundle\ServiceCenterBundle\Entity\MadeService",mappedBy="act")
     */
    private $madeServices;

    /**
     * @var Contract
     * @ORM\OneToOne(targetEntity="LysenkoVA\Bundle\ServiceCenterBundle\Entity\Contract",inversedBy="act")
     */
    private $contract;

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
     * @return ArrayCollection
     */
    public function getMadeServices()
    {
        return $this->madeServices;
    }

    /**
     * @param ArrayCollection $madeServices
     */
    public function setMadeServices($madeServices)
    {
        $this->madeServices = $madeServices;
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
     * Set date
     *
     * @param \DateTime $date
     * @return Act
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

    /**
     * Set sum
     *
     * @param float $sum
     * @return Act
     */
    public function setSum($sum)
    {
        $this->sum = $sum;

        return $this;
    }

    /**
     * Get sum
     *
     * @return float 
     */
    public function getSum()
    {
        return $this->sum;
    }
}
