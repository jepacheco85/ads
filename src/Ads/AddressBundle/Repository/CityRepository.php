<?php
namespace Ads\AddressBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Ads\AddressBundle\Entity\Country;

/**
 * CityRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */

class CityRepository extends EntityRepository
{
    public function findByTerm($term)
    {
        $query = $this->getEntityManager()->createQuery("
            SELECT city.id as id, city.name as label
            FROM AddressBundle:City city
            WHERE city.name LIKE :term
        ")->setParameter('term', '%' . $term . '%');
        return $query->getArrayResult();
    }
    
    public function findByProvinceId($province_id)
    {
        $query = $this->getEntityManager()->createQuery("
            SELECT city
            FROM AddressBundle:City city
            LEFT JOIN city.province province
            WHERE province.id = :province_id
        ")->setParameter('province_id', $province_id);
        return $query->getArrayResult();
    }
    
    public function findRandomCitiesByCountry(Country $country, $limit = null)
    {
        $queryCityIds = $this->getEntityManager()->createQuery("
            SELECT city.id
            FROM AddressBundle:City city
            LEFT JOIN city.province province
            LEFT JOIN province.country country
            WHERE country.id = :country
        ")->setParameter('country', $country->getId());
        $getId = function ($value) { return $value['id'];};
        $cityIds = array_map($getId, $queryCityIds->getArrayResult());
        if (0 === count($cityIds)) {
            return array();
        }
        shuffle($cityIds);
        if (null !== $limit && count($cityIds) >= $limit) {
            $cityIds = array_slice($cityIds, 0, $limit);
        }
        $queryCities = $this->getEntityManager()->createQuery("
            SELECT city
            FROM AddressBundle:City city
            WHERE city.id IN (:cityIds)
        ")->setParameter('cityIds', $cityIds);
        return $queryCities->getResult();
    }
}