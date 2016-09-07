<?php
/**
 * Created by PhpStorm.
 * User: jepacheco85
 * Date: 22/08/16
 * Time: 9:56
 */

namespace Ads\AddressBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 *
 * @ORM\Table(name="country")
 * @ORM\Entity
 */
class Country
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
     * @ORM\OneToMany(targetEntity="Ads\AddressBundle\Entity\Province", mappedBy="country")
     */
    protected $provinces;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->provinces = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param  string  $name
     * @return Country
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
     * @param  string  $slug
     * @return Country
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
     * Add provinces
     *
     * @param  \Ads\AddressBundle\Entity\Province $provinces
     * @return Country
     */
    public function addProvince(\Ads\AddressBundle\Entity\Province $provinces)
    {
        $this->provinces[] = $provinces;
        return $this;
    }
    /**
     * Remove provinces
     *
     * @param \Ads\AddressBundle\Entity\Province $provinces
     */
    public function removeProvince(\Ads\AddressBundle\Entity\Province $provinces)
    {
        $this->provinces->removeElement($provinces);
    }
    /**
     * Get provinces
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProvinces()
    {
        return $this->provinces;
    }
    public function __toString()
    {
        return $this->name;
    }
}