<?php
namespace Ads\AddressBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Location
{
    /**
     * @Assert\NotBlank()
     */
    public $address;
    
    /**
     * @Assert\Type("Ads\AddressBundle\Entity\City")
     * @Assert\NotNull()
     */
    public $city;
}
