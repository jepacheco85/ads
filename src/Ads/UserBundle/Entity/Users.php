<?php

namespace Ads\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Ads\AddressBundle\Entity\Address;
/**
 * Ads\UserBundle\Entity\Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="Ads\UserBundle\Repository\UserRepository")
 * @UniqueEntity("email")
 */
class Users implements \Symfony\Component\Security\Core\User\UserInterface
{
    /**
     * @var integer $userId
     *
     * @ORM\Column(name="user_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userId;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;  
    
    /**
     * @var string $lastName
     *
     * @ORM\Column(name="lastName", type="string", length=50, nullable=false)
     */
    private $lastName; 
    
    /**
     * @var boolean
     * @ORM\Column(name="sex", type="boolean", nullable=true)
     */
    private $sex;
    
    /**
     * @var boolean
     * @ORM\Column(name="iam", type="boolean", nullable=true)
     */
    private $iam;

    /**
     * @var string $cel
     *
     * @ORM\Column(name="cel", type="string", length=10, nullable=false)
     */
    private $cel;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\Email()
     */
    private $email;
    
    /**
     * @ORM\Column(name="avatar", type="string", length=255, nullable=true)
     *
     * @Assert\Image(maxSize = "500k")
     */
    private $avatar;
    
    /**
     * @var string salt
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    protected $salt;

    /**
     * @var string $password
     *
     * @ORM\Column(name="password", type="text", nullable=false)
     *
     */
    private $password;
    
    /**
     * @var \Ads\AddressBundle\Entity\Address Arreglo que contiene todas las direcciones del usuario.
     *
     * @ORM\OneToMany(targetEntity="Ads\AddressBundle\Entity\Address", mappedBy="user", cascade={"persist", "remove"})
     */
    protected $addresses;
    
     /**
     * @ORM\ManyToMany(targetEntity="Users", mappedBy="myFollow", cascade={"persist", "remove"})
     */
    protected $followWithMe;

    /**
     * @ORM\ManyToMany(targetEntity="Users", inversedBy="followWithMe")
     * @ORM\JoinTable(name="follow_users",
     * joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="user_id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="follow_user_id", referencedColumnName="user_id")})
     */
    protected $myFollow;
    
    public function __construct()
    {        
        $this->addresses = new ArrayCollection();
        $this->followWithMe = new ArrayCollection();
        $this->myFollow = new ArrayCollection();
    }
    
    public function subirFoto()
    {
        if (null === $this->avatar) {
            return; 
        }
        $directorioDestino = __DIR__.'/../../../../web/bundles/uploads/users';

        $nombreArchivoFoto = uniqid('ads-').'-1.'.$this->avatar->guessExtension();

        $this->avatar->move($directorioDestino, $nombreArchivoFoto);

        $this->setAvatar($nombreArchivoFoto);
    }
          

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Users
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
     * Set lastName
     *
     * @param string $lastName
     * @return Users
     */
    public function setlastName($lastName)
    {
        $this->lastName = $lastName;
    
        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getlastName()
    {
        return $this->lastName;
    }  
    
    /**
     * Set sex
     *
     * @param boolean $sex
     * @return Users
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return boolean
     */
    public function getSex()
    {
        return $this->sex;
    }
    
    /**
     * Set iam
     *
     * @param boolean $iam
     * @return Users
     */
    public function setIam($iam)
    {
        $this->iam = $iam;

        return $this;
    }

    /**
     * Get iam
     *
     * @return boolean
     */
    public function getIam()
    {
        return $this->iam;
    }

    /**
     * Set cel
     *
     * @param string $cel
     * @return Users
     */
    public function setCel($cel)
    {
        $this->cel = $cel;
    
        return $this;
    }

    /**
     * Get cel
     *
     * @return string 
     */
    public function getCel()
    {
        return $this->cel;
    }    
    
    
    /**
     * Set email
     *
     * @param string $email
     * @return Users
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }  
   

    public function getRoles() {
        return array('ROLE_USER');
    }
    
    public function getUsername() {
        return $this->email;
    }
    
    /**
     * Set salt
     *
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    public function eraseCredentials() {
        
    } 

    /**
     * Add address
     *
     * @param \Ads\AddressBundle\Entity\Address $address
     *
     * @return UserVs
     */
    public function addAddresse( \Ads\AddressBundle\Entity\Address $address )
    {
        $this->addresses[ ] = $address;

        return $this;
    }

    /**
     * Remove address
     *
     * @param \Ads\AddressBundle\Entity\Address $address
     */
    public function removeAddresse( \Ads\AddressBundle\Entity\Address $address )
    {
        $this->addresses->removeElement( $address );
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
     * Add followWithMe
     *
     * @param \Ads\UserBundle\Entity\Users $followWithMe
     * @return Users
     */
    public function addFollowWithMe(\Ads\UserBundle\Entity\Users $followWithMe)
    {
        $this->followWithMe[] = $followWithMe;

        return $this;
    }

    /**
     * Remove followWithMe
     *
     * @param \Ads\UserBundle\Entity\Users $followWithMe
     */
    public function removeFollowWithMe(\Ads\UserBundle\Entity\Users $followWithMe)
    {
        $this->followWithMe->removeElement($followWithMe);
    }


    /**
     * Add myFollow
     *
     * @param \Ads\UserBundle\Entity\Users $myFollow
     * @return Users
     */
    public function addMyFollow(\Ads\UserBundle\Entity\Users $myFollow)
    {
        $this->myFollow[] = $myFollow;

        return $this;
    }

    /**
     * Remove myFollow
     *
     * @param \Ads\UserBundle\Entity\Users $myFollow
     */
    public function removeMyFollow(\Ads\UserBundle\Entity\Users $myFollow)
    {
        $this->myFollow->removeElement($myFollow);
    }

    

    /**
     * Set avatar
     *
     * @param string $avatar
     *
     * @return Users
     */
    public function setAvatar( $avatar )
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }


}