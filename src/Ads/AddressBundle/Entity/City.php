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
 * Ads\AddressBundle\Entity\City
 * 
 * @ORM\Table(name="city")
 * @ORM\Entity(repositoryClass="Ads\AddressBundle\Repository\CityRepository")
 */
class City
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;
    /**
     * @var string $slug
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    protected $slug;
    /**
     * @ORM\ManyToOne(targetEntity="Ads\AddressBundle\Entity\Province", inversedBy="cities")
     * @ORM\JoinColumn(name="province_id", referencedColumnName="id")
     */
    protected $province;
    
    /**
     * @var \Ads\AnnounceBundle\Entity\Announce
     * @ORM\OneToMany(targetEntity="Ads\AnnounceBundle\Entity\Announce", mappedBy="cities")
     */
    protected $announces;
    
    /**
     * Constructor
     */
    public function __construct()
    {
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
     * @param  string $name
     * @return City
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
     * Set slug
     *
     * @param  string $slug
     * @return City
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
     * Set province
     *
     * @param  \Ads\AddressBundle\Entity\Province $province
     * @return City
     */
    public function setProvince(\Ads\AddressBundle\Entity\Province $province = null)
    {
        $this->province = $province;
        return $this;
    }
    /**
     * Get province
     *
     * @return \Ads\AddressBundle\Entity\Province
     */
    public function getProvince()
    {
        return $this->province;
    }
    /**
     * Add announces
     *
     * @param \Ads\AnnouncesBundle\Entity\Announces $announces
     * @return City
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

    public function __toString()
    {
        return $this->name;
    }
}