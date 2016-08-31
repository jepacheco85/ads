<?php
/**
 * Created by PhpStorm.
 * User: jepacheco85
 * Date: 22/08/16
 * Time: 9:56
 */

namespace Ads\AddressBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity
 */
class Address
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
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var \Ads\AddressBundle\Entity\Locality
     * @ORM\ManyToOne(targetEntity="Ads\AddressBundle\Entity\Locality")
     * @ORM\JoinColumn(name="locality_id", referencedColumnName="id")
     */
    private $locality;  
    
     /**
     * @var \Ads\UserBundle\Entity\Users Variable que hace referencia al usuario que posee esta direccion
     *
     * @ORM\ManyToOne(targetEntity="Ads\UserBundle\Entity\Users", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id", onDelete="CASCADE")
     */
    private $user;

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
     * Set street
     *
     * @param string $street
     * @return Address
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set number
     *
     * @param string $number
     * @return Address
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
     * Set between1
     *
     * @param string $between1
     * @return Address
     */
    public function setBetween1($between1)
    {
        $this->between1 = $between1;

        return $this;
    }

    /**
     * Get between1
     *
     * @return string
     */
    public function getBetween1()
    {
        return $this->between1;
    }

    /**
     * Set between2
     *
     * @param string $between2
     * @return Address
     */
    public function setBetween2($between2)
    {
        $this->between2 = $between2;

        return $this;
    }

    /**
     * Get between2
     *
     * @return string
     */
    public function getBetween2()
    {
        return $this->between2;
    }

    /**
     * Set zipCode
     *
     * @param integer $zipCode
     * @return Address
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return integer
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set state
     *
     * @param \Ads\AddressBundle\Entity\State $state
     * @return Address
     */
    public function setState(\Ads\AddressBundle\Entity\State $state = null)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return \Ads\AddressBundle\Entity\State
     */
    public function getState()
    {
        return $this->state;
    }   
    
    /**
     * Set user
     *
     * @param \Ads\UserBundle\Entity\Users $user
     * @return Address
     */
    public function setUser(\Ads\UserBundle\Entity\Users $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Ads\UserBundle\Entity\Users
     */
    public function getUser()
    {
        return $this->user;
    }

    public function __toString()
    {
        return $this->address;
    }

    public function __construct()
    {
        $this->active = true;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Address
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Address
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
     * Set locality
     *
     * @param \Ads\AddressBundle\Entity\Locality $locality
     * @return Address
     */
    public function setLocality(\Ads\AddressBundle\Entity\Locality $locality = null)
    {
        $this->locality = $locality;

        return $this;
    }

    /**
     * Get locality
     *
     * @return \Ads\AddressBundle\Entity\Locality
     */
    public function getLocality()
    {
        return $this->locality;
    }

    
}