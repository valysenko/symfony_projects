<?php

namespace LysenkoVA\Bundle\ServiceCenterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Device
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Device
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
     * @var integer
     *
     * @ORM\Column(name="serial_number", type="integer")
     */
    private $serialNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=20)
     */
    private $model;

    /**
     * @var integer
     *
     * @ORM\Column(name="number_of_model", type="integer")
     */
    private $numberOfModel;

    /**
     * @var string
     *
     * @ORM\Column(name="cendition_of_device", type="string", length=255)
     */
    private $cenditionOfDevice;

    /**
     * @var boolean
     *
     * @ORM\Column(name="warranty", type="boolean")
     */
    private $warranty;

    /**
     * @var boolean
     *
     * @ORM\Column(name="property_of_sc", type="boolean")
     */
    private $propertyOfSc;


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
     * Set serialNumber
     *
     * @param integer $serialNumber
     * @return Device
     */
    public function setSerialNumber($serialNumber)
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }

    /**
     * Get serialNumber
     *
     * @return integer 
     */
    public function getSerialNumber()
    {
        return $this->serialNumber;
    }

    /**
     * Set model
     *
     * @param string $model
     * @return Device
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return string 
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set numberOfModel
     *
     * @param integer $numberOfModel
     * @return Device
     */
    public function setNumberOfModel($numberOfModel)
    {
        $this->numberOfModel = $numberOfModel;

        return $this;
    }

    /**
     * Get numberOfModel
     *
     * @return integer 
     */
    public function getNumberOfModel()
    {
        return $this->numberOfModel;
    }

    /**
     * Set cenditionOfDevice
     *
     * @param string $cenditionOfDevice
     * @return Device
     */
    public function setCenditionOfDevice($cenditionOfDevice)
    {
        $this->cenditionOfDevice = $cenditionOfDevice;

        return $this;
    }

    /**
     * Get cenditionOfDevice
     *
     * @return string 
     */
    public function getCenditionOfDevice()
    {
        return $this->cenditionOfDevice;
    }

    /**
     * Set warranty
     *
     * @param boolean $warranty
     * @return Device
     */
    public function setWarranty($warranty)
    {
        $this->warranty = $warranty;

        return $this;
    }

    /**
     * Get warranty
     *
     * @return boolean 
     */
    public function getWarranty()
    {
        return $this->warranty;
    }

    /**
     * Set propertyOfSc
     *
     * @param boolean $propertyOfSc
     * @return Device
     */
    public function setPropertyOfSc($propertyOfSc)
    {
        $this->propertyOfSc = $propertyOfSc;

        return $this;
    }

    /**
     * Get propertyOfSc
     *
     * @return boolean 
     */
    public function getPropertyOfSc()
    {
        return $this->propertyOfSc;
    }
}
