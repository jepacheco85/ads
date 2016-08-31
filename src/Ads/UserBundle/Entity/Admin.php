<?php

namespace Ads\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ads\UserBundle\Entity\Admin
 *
 * @ORM\Table(name="admin")
 * @ORM\Entity
 */
class Admin implements \Symfony\Component\Security\Core\User\UserInterface
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=true)
     */
    private $email;
    
    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @var string $password
     * @ORM\Column(name="password", type="text", nullable=true)
     */
    private $password;
    
    /**
     * @var string salt
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    protected $salt;



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
     * Set email
     *
     * @param string $email
     * @return Admin
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
     * Set email
     *
     * @param string $email
     * @return Admin
     */
    public function setName($email)
    {
        $this->name = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set password
     *
     * @param string $password
     * @return Admin
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
        return array("ROLE_ADMIN");
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
}