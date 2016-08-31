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
 * 
 * @package Ads\AddressBundle\Entity
 * @ORM\Table(name="locality")
 * @ORM\Entity(repositoryClass="Ads\AnnounceBundle\Repository\AnnounceLocationRepository")
 */
class Locality {
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
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;
    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=100)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="postal_code", type="string", length=100)
     */
    private $postalCode;    

    /**
     * @var \Ads\AddressBundle\Entity\State
     * @ORM\ManyToOne(targetEntity="Ads\AddressBundle\Entity\State")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="id")
     */
    private $state;

    /**
     * @var \Ads\AddressBundle\Entity\Address
     * @ORM\OneToMany(targetEntity="Ads\AddressBundle\Entity\Address", mappedBy="locality")
     */
    private $addresses;
    
    /**
     * @var \Ads\AnnounceBundle\Entity\Announce
     * @ORM\OneToMany(targetEntity="Ads\AnnounceBundle\Entity\Announce", mappedBy="locality")
     */
    private $announces;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->addresses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->announces = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Locality
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
     * Add addresses
     *
     * @param \Ads\AddressBundle\Entity\Address $addresses
     * @return Locality
     */
    public function addAddresse(\Ads\AddressBundle\Entity\Address $addresses)
    {
        $this->addresses[] = $addresses;
    
        return $this;
    }

    /**
     * Remove addresses
     *
     * @param \Ads\AddressBundle\Entity\Address $addresses
     */
    public function removeAddresse(\Ads\AddressBundle\Entity\Address $addresses)
    {
        $this->addresses->removeElement($addresses);
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
     * Add announces
     *
     * @param \Ads\AnnouncesBundle\Entity\Announces $announces
     * @return Locality
     */
    public function addAnnounce(\Ads\AnnounceBundle\Entity\Announce $announces)
    {
        $this->announces[] = $announces;
    
        return $this;
    }

    /**
     * Remove announces
     *
     * @param \Ads\AnnounceBundle\Entity\Announce $announces
     */
    public function removeAnnounce(\Ads\AnnounceBundle\Entity\Announce $announces)
    {
        $this->announces->removeElement($announces);
    }

    /**
     * Get announces
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnnounces()
    {
        return $this->announces;
    }

    /**
     * Set state
     *
     * @param \Ads\AddressBundle\Entity\State $state
     * @return Locality
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
     * Set postalCode
     *
     * @param string $postalCode
     * @return Locality
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    
        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string 
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Locality
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
    
    public function __toString()
    {
        return $this->name;
    }
}