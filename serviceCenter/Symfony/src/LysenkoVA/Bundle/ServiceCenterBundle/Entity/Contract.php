<?php

namespace LysenkoVA\Bundle\ServiceCenterBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Contract
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Contract
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
     * @ORM\Column(name="number", type="string", length=25)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=20)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_of_end", type="date")
     */
    private $dateOfEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @var float
     *
     * @ORM\Column(name="approximate_price", type="float")
     */
    private $approximatePrice;

    /**
     * @var Employee
     * @ORM\ManyToOne(targetEntity="LysenkoVA\Bundle\ServiceCenterBundle\Entity\Employee",inversedBy="contracts")
     */
    private $employee;

    /**
     * @var Act
     * @ORM\OneToOne(targetEntity="LysenkoVA\Bundle\ServiceCenterBundle\Entity\Act",mappedBy="contract")
     */
    private $act;

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
     * @ORM\OneToOne(targetEntity="LysenkoVA\Bundle\ServiceCenterBundle\Entity\Device",cascade={"persist"},orphanRemoval=true)
     * @ORM\JoinColumn(name="device_id", referencedColumnName="id")
     **/
    private $device;

    /**
     * @return mixed
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @param mixed $device
     */
    public function setDevice($device)
    {
        $this->device = $device;
    }


    /**
     * @return Employee
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * @param Employee $employee
     */
    public function setEmployee($employee)
    {
        $this->employee = $employee;
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
     * Set number
     *
     * @param string $number
     * @return Contract
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Contract
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
     * Set status
     *
     * @param string $status
     * @return Contract
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set dateOfEnd
     *
     * @param \DateTime $dateOfEnd
     * @return Contract
     */
    public function setDateOfEnd($dateOfEnd)
    {
        $this->dateOfEnd = $dateOfEnd;

        return $this;
    }

    /**
     * Get dateOfEnd
     *
     * @return \DateTime 
     */
    public function getDateOfEnd()
    {
        return $this->dateOfEnd;
    }

    /**
     * Set approximatePrice
     *
     * @param float $approximatePrice
     * @return Contract
     */
    public function setApproximatePrice($approximatePrice)
    {
        $this->approximatePrice = $approximatePrice;

        return $this;
    }

    /**
     * Get approximatePrice
     *
     * @return float 
     */
    public function getApproximatePrice()
    {
        return $this->approximatePrice;
    }
}
