<?php
/**
 * Created by PhpStorm.
 * User: Jepacheco
 * Date: 07/06/16
 * Time: 12:33 AM
 */

namespace Ads\AnnounceBundle\Repository;


use Doctrine\ORM\EntityRepository;

class AnnounceCategoryRepository extends EntityRepository{
    
    
   /**
   * Devuelve una lista de anuncio por subcategoria
   *
   */
    public function getPopularSubCategory($subcategory)
    {               
        $em = $this->getEntityManager();        
        
        return $this->createQueryBuilder('q')
            ->leftJoin('q.announce','a')
            ->leftJoin('q.subcategory','s')
            ->andWhere('q.subcategoryId = :subcategory')
            ->setParameter('subcategory', $subcategory)
            ->select('COUNT(q.announceId) as cant')
            ->getQuery()
            ->getOneOrNullResult();
    }      
   
} 