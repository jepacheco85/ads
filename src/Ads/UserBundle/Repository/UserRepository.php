<?php
/**
 * Created by PhpStorm.
 * User: Jepacheco
 * Date: 07/06/16
 * Time: 12:33 AM
 */

namespace Ads\UserBundle\Repository;


use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository{
    
  public function getMyFollowing($userId)
  {
    $em = $this->getEntityManager();        
        
        /*return $follow = $em->createQueryBuilder()
        ->select('a')                
        ->addSelect('COUNT(s) num')
        ->from('AnnounceBundle:Announce', 'a')
        ->leftJoin('a.subcategory', 's')
        ->where('a.subcategory = :subcategory')
        ->setParameter('subcategory', $subcategory)
        ->groupBy('a.announceId')
        ->getQuery()                
        ->getOneOrNullResult();*/
    
    return $follow = $em->createQueryBuilder()
        ->select('u, f')  
        //->addSelect('COUNT(f) num')    
        ->from('UserBundle:Users', 'u')
        ->leftJoin('u.followWithMe', 'f')
        ->where('f.userId = :user')
        ->setParameter('user', $userId)
        //->groupBy('a.announceId')
        ->getQuery()                
        ->getResult();
        
  }  
    
  public function getMyFollowers($userId)
  {
    $em = $this->getEntityManager();
       
    return $follow = $em->createQueryBuilder()
        ->select('u, f')  
        //->addSelect('COUNT(f) num')    
        ->from('UserBundle:Users', 'u')
        ->leftJoin('u.myFollow', 'f')
        ->where('f.userId = :user')
        ->setParameter('user', $userId)
        //->groupBy('a.announceId')
        ->getQuery()                
        ->getResult();
        
  }
} 