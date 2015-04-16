<?php

namespace LysenkoVA\Bundle\ServiceCenterBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Contract
 *
 * @ORM\Table()
 *  @ORM\Entity(repositoryClass="LysenkoVA\Bundle\ServiceCenterBundle\Repository\ContractRepository")
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
     * @Assert\GreaterThanOrEqual("+1 day")
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
     * @Assert\Range(min = "1", minMessage = "Price should be greater then 0.")
     * @ORM\Column(name="approximate_price", type="float")
     */
    private $approximatePrice;

    /**
     * ON DELETE SET NULL in database
     * @var Employee
     * @ORM\ManyToOne(targetEntity="LysenkoVA\Bundle\ServiceCenterBundle\Entity\Employee",inversedBy="contractsManaged")
     */
    private $manager;

    /**
     * @return Employee
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * @param Employee $manager
     */
    public function setManager($manager)
    {
        $this->manager = $manager;
    }

    /**
     * @return Employee
     */
    public function getMaster()
    {
        return $this->master;
    }

    /**
     * @param Employee $master
     */
    public function setMaster($master)
    {
        $this->master = $master;
    }

    /**
     * ON DELETE SET NULL in database
     * @var Employee
     * @ORM\ManyToOne(targetEntity="LysenkoVA\Bundle\ServiceCenterBundle\Entity\Employee",inversedBy="contractsMasters", cascade={"detach"})
     */
    private $master;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="LysenkoVA\Bundle\ServiceCenterBundle\Entity\MadeService",mappedBy="contract",orphanRemoval=true)
     */
    private $madeServices;
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
     * @param MadeService $madeService
     * @return $this
     */
    public function addMadeService(MadeService $madeService)
    {
        $this->madeServices[] = $madeService;
        return $this;
    }

    /**
     * @param MadeService $madeService
     * @return $this
     */
    public function removeMadeService(MadeService $madeService)
    {
        $this->madeServices->removeElement($madeService);
        return $this;
    }

    /**
     * @ORM\OneToOne(targetEntity="LysenkoVA\Bundle\ServiceCenterBundle\Entity\Device",cascade={"persist"},orphanRemoval=true)
     * @ORM\JoinColumn(name="device_id", referencedColumnName="id")
     **/
    private $device;

    /**
     * @var float
     * @ORM\Column(name="sum", type="float")
     */
    private $sum;

    /**
     * @return float
     */
    public function getSum()
    {
        return $this->sum;
    }

    /**
     * @param float $sum
     */
    public function setSum($sum)
    {
        $this->sum = $sum;
    }


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
