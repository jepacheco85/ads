<?php
/**
 * Created by PhpStorm.
 * User: jepacheco85
 * Date: 22/08/16
 * Time: 9:56
 */

namespace Ads\AddressBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity
 */
class Address
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
     * @var string $street
     *
     * @ORM\Column(name="street", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $street;
    /**
     * @ORM\ManyToOne(targetEntity="Ads\AddressBundle\Entity\City")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     * @Assert\Type("Ads\AddressBundle\Entity\City")
     * @Assert\NotNull()
     */
    protected $city;
    /**
     * @ORM\ManyToOne(targetEntity="Ads\UserBundle\Entity\Users", inversedBy="addresses")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     */
    protected $user;
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
     * Set street
     *
     * @param  string  $street
     * @return Address
     */
    public function setStreet($street)
    {
        $this->street = $street;
        return $this;
    }
    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }
    /**
     * Set city
     *
     * @param  \Ads\AddressBundle\Entity\City $city
     * @return Address
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
     * Set user
     *
     * @param  \Ads\UserBundle\Entity\Users $user
     * @return Address
     */
    public function setUser(\Ads\UserBundle\Entity\Users $user = null)
    {
        $this->user = $user;
        return $this;
    }
    /**
     * Get user
     *
     * @return \Ads\UserBundle\Entity\Users
     */
    public function getUser()
    {
        return $this->user;
    }
}