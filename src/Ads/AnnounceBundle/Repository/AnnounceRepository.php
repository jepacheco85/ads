<?php
/**
 * Created by PhpStorm.
 * User: Jepacheco
 * Date: 07/06/16
 * Time: 12:33 AM
 */

namespace Ads\AnnounceBundle\Repository;


use Doctrine\ORM\EntityRepository;

class AnnounceRepository extends EntityRepository{
    
    public function getPopularSubCategory($subcategory)
    {   
        $em = $this->getEntityManager();        
        
        return $sub = $em->createQueryBuilder()
        ->select('a')                
        ->addSelect('COUNT(s) num')
        ->from('AnnounceBundle:Announce', 'a')
        ->leftJoin('a.subcategory', 's')
        ->where('a.subcategory = :subcategory')
        ->setParameter('subcategory', $subcategory)
        ->groupBy('a.announceId')
        ->getQuery()                
        ->getResult();        
    } 
    
    public function getPopularLocation($locality)
    {   
        $em = $this->getEntityManager();        
        
        return $sub = $em->createQueryBuilder()
        ->select('a')                
        ->addSelect('COUNT(l) num')
        ->from('AnnounceBundle:Announce', 'a')
        ->leftJoin('a.city', 'l')
        ->where('a.city = :locality')
        ->setParameter('locality', $locality)
        ->groupBy('a.announceId')
        ->getQuery()                
        ->getResult();        
    } 
    
    public function getFeatured()
    {               
        $em = $this->getEntityManager();
        
        $query = $em->createQuery('
            SELECT a 
            FROM AnnounceBundle:Announce a 
            WHERE a.post < :fecha AND a.path IS NOT NULL
            ORDER BY a.post DESC
        ');
        $query->setParameter('fecha', new \DateTime('now'));
        $query->setMaxResults(10);
        return $query->getResult();
    }
    
    /**
   * Devuelve una lista de anuncio hecha por el usuario
   *
   */
    public function getAnnouncesByUser($user)
    {
       $em = $this->getEntityManager();
        
        $query = $em->createQuery('
            SELECT a 
            FROM AnnounceBundle:Announce a JOIN a.user u 
            WHERE a.user = :user
            ORDER BY a.post ASC
        ');
        $query->setParameter('user', $user);
        return $query->getResult();
    }

   /**
   * Devuelve una lista de anuncio por subcategoria y localidad
   *
   */
    public function getCategoryLocality($subcategory, $locality)
    {               
        $em = $this->getEntityManager();
        
        $query = $em->createQuery('
            SELECT a 
            FROM AnnounceBundle:Announce a
            WHERE a.subcategory = :subcategory AND a.city = :locality 
        ');
        $query->setParameter('subcategory', $subcategory);
        $query->setParameter('locality', $locality);
        $query->setMaxResults(10);
        return $query->getResult();
    }
    
   /**
   * Devuelve una lista de las 8 promociones que menos tiempo quedan para que terminen
   *
   */
    public function getBusinessByFinalDeals($category, $cant = 8)
    {               
        $em = $this->getEntityManager();
        
        $query = $em->createQuery('
            SELECT b 
            FROM VivimBusinessBundle:UserBusiness b JOIN b.business_categories c 
            WHERE c.category = :category AND b.updated > :fecha
            ORDER BY b.updated DESC
        ');
        $query->setParameter('category', $category);
        $query->setParameter('fecha', new \DateTime('now'));
        $query->setMaxResults($cant);
        return $query->getResult();
    }
    
    public function getPopularActivityToday($category, $cant = 5)
    {               
        $em = $this->getEntityManager();
        
        $query = $em->createQuery('
            SELECT b 
            FROM VivimBusinessBundle:UserBusiness b JOIN b.business_categories c 
            WHERE c.category = :category AND b.updated > :fecha
            ORDER BY b.updated DESC
        ');
        $query->setParameter('category', $category);
        $query->setParameter('fecha', new \DateTime('now'));
        $query->setMaxResults($cant);
        return $query->getResult();
    }
} 