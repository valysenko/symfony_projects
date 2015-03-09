<?php

namespace LysenkoVA\Bundle\ServiceCenterBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Department
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Department
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
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone_number", type="string", length=20)
     */
    private $telephoneNumber;

    /**
     * @return ArrayCollection
     */
    public function getComplaints()
    {
        return $this->complaints;
    }

    /**
     * @param ArrayCollection $complaints
     */
    public function setComplaints($complaints)
    {
        $this->complaints = $complaints;
    }

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="LysenkoVA\Bundle\ServiceCenterBundle\Entity\Complaint",mappedBy="department")
     */
    private $complaints;

    /**
     * @return ArrayCollection
     */
    public function getEmployees()
    {
        return $this->employees;
    }

    /**
     * @param ArrayCollection $employees
     */
    public function setEmployees($employees)
    {
        $this->employees = $employees;
    }

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="LysenkoVA\Bundle\ServiceCenterBundle\Entity\Employee",mappedBy="department")
     */
    private $employees;

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
     * Set address
     *
     * @param string $address
     * @return Department
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set telephoneNumber
     *
     * @param string $telephoneNumber
     * @return Department
     */
    public function setTelephoneNumber($telephoneNumber)
    {
        $this->telephoneNumber = $telephoneNumber;

        return $this;
    }

    /**
     * Get telephoneNumber
     *
     * @return string 
     */
    public function getTelephoneNumber()
    {
        return $this->telephoneNumber;
    }

    /**
     * Add userRoles
     */
    public function addEmployee(Employee $employee)
    {
        $this->employees[] = $employee;
        return $this;
    }
}
