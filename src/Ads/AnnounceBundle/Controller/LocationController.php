<?php

namespace Ads\AnnounceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LocationController extends Controller
{
    public function locationsPopularAction()
    {
        $em = $this->get('doctrine')->getManager();
        
        $localities = $em->getRepository('AddressBundle:City')->findAll();
      
     foreach ($localities as $locality){         
          $sub = $em->getRepository('AnnounceBundle:Announce')->getPopularLocation($locality->getId());
          $result[] = array(
                  'id' => $locality->getId(),
                  'name' => $locality->getName(),
                  'cant' => count($sub)
            );          
     }    
     
     
    for( $i = 1; $i < count($result) ; $i++ ){
         for( $j = 0; $j < count($result)-1; $j++ ){
             if($result[$j]['cant'] < $result[$j+1]['cant']){
                 $tempId = $result[$j]['id'];
                 $tempC = $result[$j]['cant'];
                 $tempN = $result[$j]['name'];
                 $result[$j]['id'] = $result[$j+1]['id'];
                 $result[$j]['cant'] = $result[$j+1]['cant'];
                 $result[$j]['name'] = $result[$j+1]['name'];
                 $result[$j+1]['id'] = $tempId;
                 $result[$j+1]['cant'] = $tempC;
                 $result[$j+1]['name'] = $tempN;
             }
         }
     }  
     $aux = array();
     for( $i = 0; $i < 10 ; $i++ ){
         $aux[$i] = $result[$i];
     }
     
     $aux2 = array();
     for( $i = 10; $i < 20 ; $i++ ){
         $aux2[$i] = $result[$i];
     }
  
       return $this->render('TplFrontendBundle:Announce:announce-popular-locations.html.twig', array(
           'locations' => $aux,
           'locations2' => $aux2));
    }
    
    public function locationsPopularSideBarAction()
    {
        $em = $this->get('doctrine')->getManager();
        
        $locations = $em->getRepository('AddressBundle:City')->findAll();
      
     foreach ($locations as $locality){         
          $sub = $em->getRepository('AnnounceBundle:Announce')->getPopularLocation($locality->getId());
          $result[] = array(
                  'id' => $locality->getId(),
                  'name' => $locality->getName(),
                  'cant' => count($sub)
            );          
     }    
     
     
    for( $i = 1; $i < count($result) ; $i++ ){
         for( $j = 0; $j < count($result)-1; $j++ ){
             if($result[$j]['cant'] < $result[$j+1]['cant']){
                 $tempId = $result[$j]['id'];
                 $tempC = $result[$j]['cant'];
                 $tempN = $result[$j]['name'];
                 $result[$j]['id'] = $result[$j+1]['id'];
                 $result[$j]['cant'] = $result[$j+1]['cant'];
                 $result[$j]['name'] = $result[$j+1]['name'];
                 $result[$j+1]['id'] = $tempId;
                 $result[$j+1]['cant'] = $tempC;
                 $result[$j+1]['name'] = $tempN;
             }
         }
     }  
     $aux = array();
     for( $i = 0; $i < 20 ; $i++ ){
         $aux[$i] = $result[$i];
     }  
  
       return $this->render('TplFrontendBundle:Sidebar:sidebar-left-locations.html.twig', array('locations' => $aux));
    }
}
