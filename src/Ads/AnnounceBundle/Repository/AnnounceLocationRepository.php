<?php
/**
 * Created by PhpStorm.
 * User: Jepacheco
 * Date: 07/06/16
 * Time: 12:33 AM
 */

namespace Ads\AnnounceBundle\Repository;


use Doctrine\ORM\EntityRepository;

class AnnounceLocationRepository extends EntityRepository{
    
    
   /**
   * Devuelve una lista de anuncio por location
   *
   */
    public function getPopularLocation($location)
    {               
        return $this->createQueryBuilder('q')
            ->leftJoin('q.announces','a')
            ->leftJoin('q.locality','l')
            ->andWhere('a.localityId = :locality')
            ->setParameter('locality', $location)
            ->select('COUNT(q.announceId) as cant')
            ->getQuery()
            ->getOneOrNullResult();
    }    
} 