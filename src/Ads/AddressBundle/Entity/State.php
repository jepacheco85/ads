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
 * State
 *
 * @ORM\Table(name="state")
 * @ORM\Entity
 */
class State
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="abrev", type="string", length=255)
     */
    private $abrev;

    /**
     * @var \Ads\AddressBundle\Entity\Country
     * @ORM\ManyToOne(targetEntity="Ads\AddressBundle\Entity\Country")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     */
    private $country;
    
    /**
     * @var \Ads\AddressBundle\Entity\Locality
     * @ORM\OneToMany(targetEntity="Ads\AddressBundle\Entity\Locality", mappedBy="state")
     */
    private $locality;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->addresses = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return State
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
     * Set statePrefix
     *
     * @param string $statePrefix
     * @return State
     */
    public function setStatePrefix($statePrefix)
    {
        $this->statePrefix = $statePrefix;
    
        return $this;
    }

    /**
     * Get statePrefix
     *
     * @return string 
     */
    public function getStatePrefix()
    {
        return $this->statePrefix;
    }

    /**
     * Set areaCode
     *
     * @param string $areaCode
     * @return State
     */
    public function setAreaCode($areaCode)
    {
        $this->areaCode = $areaCode;
    
        return $this;
    }

    /**
     * Get areaCode
     *
     * @return string 
     */
    public function getAreaCode()
    {
        return $this->areaCode;
    }

    /**
     * Set timeZone
     *
     * @param string $timeZone
     * @return State
     */
    public function setTimeZone($timeZone)
    {
        $this->timeZone = $timeZone;
    
        return $this;
    }

    /**
     * Get timeZone
     *
     * @return string 
     */
    public function getTimeZone()
    {
        return $this->timeZone;
    }

    /**
     * Set country
     *
     * @param \Ads\AddressBundle\Entity\Country $country
     * @return State
     */
    public function setCountry(\Ads\AddressBundle\Entity\Country $country = null)
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * Get country
     *
     * @return \Ads\AddressBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }
    
    /**
     * Add address
     *
     * @param \Ads\AddressBundle\Entity\Address $address
     * @return State
     */
    public function addAddress(\Ads\AddressBundle\Entity\Address $address)
    {
        $this->addresses[] = $address;
    
        return $this;
    }

    /**
     * Remove address
     *
     * @param \Ads\AddressBundle\Entity\Address $address
     */
    public function removeAddress(\Ads\AddressBundle\Entity\Address $address)
    {
        $this->addresses->removeElement($address);
    }

    /**
     * Get addresses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * Add locality
     *
     * @param \Ads\AddressBundle\Entity\Locality $locality
     * @return State
     */
    public function addLocality(\Ads\AddressBundle\Entity\Locality $locality)
    {
        $this->locality[] = $locality;
    
        return $this;
    }

    /**
     * Remove locality
     *
     * @param \Ads\AddressBundle\Entity\Locality $locality
     */
    public function removeLocality(\Ads\AddressBundle\Entity\Locality $locality)
    {
        $this->locality->removeElement($locality);
    }

    /**
     * Get locality
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLocality()
    {
        return $this->locality;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return State
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set abrev
     *
     * @param string $abrev
     * @return State
     */
    public function setAbrev($abrev)
    {
        $this->abrev = $abrev;
    
        return $this;
    }

    /**
     * Get abrev
     *
     * @return string 
     */
    public function getAbrev()
    {
        return $this->abrev;
    }
}