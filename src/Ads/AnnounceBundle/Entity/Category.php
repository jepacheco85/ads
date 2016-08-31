<?php

namespace Ads\AnnounceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ads\AnnounceBundle\Entity\Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity
 */
class Category
{
    /**
     * @var integer $categoryId
     *
     * @ORM\Column(name="category_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $categoryId;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name;
    
    /**
     * @var string $slug
     *
     * @ORM\Column(name="slug", type="string", length=100, unique=true)
     */
    private $slug;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=1000)
     */
    private $description;  
    
    /**
     * @var string $icon
     *
     * @ORM\Column(name="icon", type="string", length=50, nullable=true)
     */
    private $icon;
    
    /**
     * @ORM\OneToMany(targetEntity="Subcategory", mappedBy="category", cascade="remove")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="category_id")
     */
    protected $subcategories;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->subcategories = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get categoryId
     *
     * @return integer 
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Category
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
     * @return Category
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
     * @return Category
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
     * Set icon
     *
     * @param string $icon
     * @return Category
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    
        return $this;
    }

    /**
     * Get icon
     *
     * @return string 
     */
    public function getIcon()
    {
        return $this->icon;
    }
    
    /**
     * Add subcategories
     *
     * @param \Ads\AnnounceBundle\Entity\SubCategory $subcategory
     * @return Category
     */
    public function addSubcategory(\Ads\AnnounceBundle\Entity\Subcategory $subcategory)
    {
        $this->subcategories[] = $subcategory;

        return $this;
    }

    /**
     * Remove subcategories
     *
     * @param \Ads\AnnounceBundle\Entity\SubCategory $subcategory
     */
    public function removeSubcategory(\Ads\AnnounceBundle\Entity\SubCategory $subcategory)
    {
        $this->subcategories->removeElement($subcategory);
    }
    
    /**
     * Set Subcategory
     *
     * @param Ads\AnnounceBundle\Entity\Subcategory $subcategory
     */
    public function setSubcategory(\Ads\AnnounceBundle\Entity\Subcategory $subcategory)
    {
        $this->subcategory = $subcategory;
    }

    /**
     * Get subcategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubcategories()
    {
        return $this->subcategories;
    }
    
    public function __toString()
    {
        return $this->name;
    }   
    
}