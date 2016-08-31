<?php

namespace Ads\AnnounceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ads\AnnounceBundle\Entity\Subcategory
 *
 * @ORM\Table(name="subcategory")
 * @ORM\Entity
 */
class Subcategory
{
    /**
     * @var integer $subcategoryId
     *
     * @ORM\Column(name="subcategory_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $subcategoryId;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    private $name;    
    
    /**
     * @var string slug
     *
     * @ORM\Column(name="slug", type="string", length=100, unique=true)
     */
    private $slug;

    /**
     * @var string description
     *
     * @ORM\Column(name="description", type="string", length=1000)
     */
    private $description;

    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="subcategories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="category_id")
     * })
     */
    protected $category; 
    
    /**
     * @ORM\OneToMany(targetEntity="Subcategory", mappedBy="parent")
     */
    protected $announces;
    
    /**
     * @ORM\ManyToOne(targetEntity="Subcategory", inversedBy="announces",cascade={"remove"})
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="subcategory_id", onDelete="CASCADE")
     */
    protected $parent;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->announces = new \Doctrine\Common\Collections\ArrayCollection();
    }     

    /**
     * Get subcategoryId
     *
     * @return integer 
     */
    public function getSubcategoryId()
    {
        return $this->subcategoryId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Subcategory
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
     * @param string $slug
     * @return Company
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
     * Set description
     *
     * @param string $description
     * @return Subcategory
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
     * Set category
     *
     * @param Ads\AnnounceBundle\Entity\Category $category
     * @return Subcategory
     */
    public function setCategory(\Ads\AnnounceBundle\Entity\Category $category = null)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return Ads\AnnounceBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
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
     * Add announces
     *
     * @param \Ads\AnnounceBundle\Entity\Subcategory $announces
     * @return Subcategory
     */
    public function addAnnounce(\Ads\AnnounceBundle\Entity\Subcategory $announces)
    {
        $this->announces[] = $announces;

        return $this;
    }

    /**
     * Remove announces
     *
     * @param \Ads\AnnounceBundle\Entity\Subcategory $announces
     */
    public function removeAnnounce(\Ads\AnnounceBundle\Entity\Subcategory $announces)
    {
        $this->announces->removeElement($announces);
    }
    
    /**
     * Set parent
     *
     * @param \Ads\AnnounceBundle\Entity\Subcategory $parent
     * @return Subcategory
     */
    public function setParent(\Ads\AnnounceBundle\Entity\Subcategory $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Ads\AnnounceBundle\Entity\Subcategory
     */
    public function getParent()
    {
        return $this->parent;
    }
    
    public function __toString()
    {
        return $this->name;
    }


}
