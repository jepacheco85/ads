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
 * Ads\AddressBundle\Entity\Province
 *
 * @ORM\Table(name="province")
 * @ORM\Entity(repositoryClass="Ads\AddressBundle\Repository\ProvinceRepository")
 */
class Province
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
     * @ORM\ManyToOne(targetEntity="Ads\AddressBundle\Entity\Country", inversedBy="provinces")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     */
    protected $country;
    /**
     * @ORM\OneToMany(targetEntity="Ads\AddressBundle\Entity\City", mappedBy="province")
     */
    protected $cities;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cities = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param  string   $name
     * @return Province
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
     * @param  string   $slug
     * @return Province
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
     * Set country
     *
     * @param  \Ads\AddressBundle\Entity\Country $country
     * @return Province
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
     * Add cities
     *
     * @param  \Ads\AddressBundle\Entity\City $cities
     * @return Province
     */
    public function addCity(\Ads\AddressBundle\Entity\City $cities)
    {
        $this->cities[] = $cities;
        return $this;
    }
    /**
     * Remove cities
     *
     * @param \Ads\AddressBundle\Entity\City $cities
     */
    public function removeCity(\Ads\AddressBundle\Entity\City $cities)
    {
        $this->cities->removeElement($cities);
    }
    public function __toString()
    {
        return $this->name;
    }
    /**
     * Get cities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCities()
    {
        return $this->cities;
    }
}