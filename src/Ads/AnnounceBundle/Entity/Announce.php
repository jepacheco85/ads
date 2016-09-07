<?php

namespace Ads\AnnounceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ads\AnnounceBundle\Entity\Announce
 *
 * @ORM\Table(name="announce")
 * @ORM\Entity(repositoryClass="Ads\AnnounceBundle\Repository\AnnounceRepository")
 */
class Announce 
{
    /**
     * @var integer $announceId
     *
     * @ORM\Column(name="announceId", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $announceId;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    private $title;
    
    /**
     * @var boolean $type
     *
     * @ORM\Column(name="type", type="boolean", nullable=false)
     */
    private $type;
    
    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=100, nullable=false)
     */
    private $description;     
    
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="price", type="decimal" , scale=2, nullable=false)
     */
    private $price;    

    /**
     * @var boolean $negotiable
     *
     * @ORM\Column(name="negotiable", type="boolean", nullable=false)
     */
    private $negotiable;  
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="post", type="datetime", nullable=true)
     */
    private $post;
    
    /**
     * @ORM\Column(type="json_array", nullable=true)
     */
    public $path;

    /**
     * @var array
     */
    public $imagenes;
    
    /**
     * @var \Ads\AddressBundle\Entity\City
     * @ORM\ManyToOne(targetEntity="Ads\AddressBundle\Entity\City")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    private $city;

    /**
     * @var Subcategory
     *
     * @ORM\ManyToOne(targetEntity="Subcategory", inversedBy="announces")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="subcategory_id", referencedColumnName="subcategory_id")
     * })
     */
    protected $subcategory;
    
    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Ads\UserBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * })
     */
    private $user;
    
   
    /**
     * Get announceId
     *
     * @return integer 
     */
    public function getAnnounceId()
    {
        return $this->announceId;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Announce
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Set type
     *
     * @param boolean $type
     * @return Announce
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return boolean
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * Set description
     *
     * @param string $description
     * @return Announce
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
     * Set price
     *
     * @param decimal $price
     * @return Announce
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Get price
     *
     * @return decimal
     */
    public function getPrice()
    {
        return $this->price;
    }   

    /**
     * Set negotiable
     *
     * @param boolean $negotiable
     * @return Announce
     */
    public function setNegotiable($negotiable)
    {
        $this->negotiable = $negotiable;
    
        return $this;
    }

    /**
     * Get negotiable
     *
     * @return boolean
     */
    public function getNegotiable()
    {
        return $this->negotiable;
    }
    
    /**
     * Set post
     *
     * @param \DateTime $post
     * @return Announce
     */
    public function setPost($post)
    {
        $this->post = $post;
    
        return $this;
    }

    /**
     * Get post
     *
     * @return \DateTime 
     */
    public function getPost()
    {
        return $this->post;
    }
    
    /**
     * Set city
     *
     * @param \Ads\AddressBundle\Entity\City $city
     * @return Announce
     */
    public function setCity(\Ads\AddressBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \Ads\AddressBundle\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }


    /**
     * Set subcategory
     *
     * @param Ads\AnnounceBundle\Entity\Subcategory $subcategory
     * @return Announce
     */
    public function setSubcategory(\Ads\AnnounceBundle\Entity\Subcategory $subcategory = null)
    {
        $this->subcategory = $subcategory;
    
        return $this;
    }

    /**
     * Get subcategory
     *
     * @return Ads\AnnounceBundle\Entity\Subcategory
     */
    public function getSubcategory()
    {
        return $this->subcategory;
    }
   
    
    /**
     * Set user
     *
     * @param Ads\UserBundle\Entity\Users $user
     * @return Announce
     */
    public function setUser(\Ads\UserBundle\Entity\Users $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return Ads\UserBundle\Entity\Users
     */
    public function getUser()
    {
        return $this->user;
    }
    
    public function __toString()
    {
        return $this->name;
    }
   
    /**
     * Set path
     *
     * @param text $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Get path
     *
     * @return text
     */
    public function getPath()
    {
        $this->path;
    }

    public function getImagenes(){
        
        return $this->imagenes;
    }

    public function setImagenes(array $imagenes){
        $this->imagenes = $imagenes;
    }
    public function __construct(){
        $this->imagenes = array();
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'bundles/uploads/announces';
    }
    
    public function upload()
    {
        $mypath = json_decode($this->path);
        foreach ($this->imagenes as $key => $value) {
            if ($value){
                //Definir un nombre valido para el archivo
                //Gedmo es una de las extensiones de Doctrine para Sluggable, Timestampable, etc
                //$nombre = \Gedmo\Sluggable\Util\Urlizer::urlize($value->getClientOriginalName(), '-');

                 $cadena = uniqid('ads-').'-1.'.$value->guessExtension();
                //Verificar la extension para guardar la imagen
                $extension = $value->guessExtension();

                $extvalidas = array('JPG','JPEG','PNG','GIF');

                if ( !in_array(strtoupper($extension), $extvalidas)){
                    return;
                }

                //Quitar la extension del nombre generado
                //caso contrario el nombre queda algo como:  miimagen-jpg

                $nombre = str_replace(' ', '', $cadena);

                //Nombre final con extension
                //Queda algo como: miimagen.jpg
                $nombreFinal = $nombre;

                //Verificar si la imagen ya esta almacenada
                if (@in_array($nombreFinal, $mypath)){
                    //si la imagen ya esta almacenada, se continua con el siguiente item
                    continue;
                }

                //Almacenar la imagen en el servidor
                $value->move($this->getUploadRootDir(), $nombreFinal);

                //Agregar el nuevo nombre al final del Array
                //echo $nombreFinal;
                $mypath[] = $nombreFinal;
            }
        }
        //$test = array_merge($this->path,$mypath);
        $this->path = json_decode(json_encode($mypath));
        $this->imagenes = array();
    }  
}