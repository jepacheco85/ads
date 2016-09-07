<?php

namespace Ads\AnnounceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryController extends Controller
{
    public function categoriesAction()
    {
        return $this->render('AnnounceBundle:Category:categories.html.twig');
    }
    
    public function categoriesPopularAction()
    {
        $em = $this->get('doctrine')->getManager();
        
        $subcategories = $em->getRepository('AnnounceBundle:Subcategory')->findAll();
      
     foreach ($subcategories as $subcategory){         
          $sub = $em->getRepository('AnnounceBundle:Announce')->getPopularSubCategory($subcategory->getSubcategoryId());
          $result[] = array(
                'slug' => $subcategory->getSlug(),
                'name' => $subcategory->getName(),
                'cant' => count($sub)
            );      
     }
     
    for( $i = 1; $i < count($result) ; $i++ ){
         for( $j = 0; $j < count($result)-1; $j++ ){
             if($result[$j]['cant'] < $result[$j+1]['cant']){
                 $tempId = $result[$j]['slug'];
                 $tempC = $result[$j]['cant'];
                 $tempN = $result[$j]['name'];
                 $result[$j]['slug'] = $result[$j+1]['slug'];
                 $result[$j]['cant'] = $result[$j+1]['cant'];
                 $result[$j]['name'] = $result[$j+1]['name'];
                 $result[$j+1]['slug'] = $tempId;
                 $result[$j+1]['cant'] = $tempC;
                 $result[$j+1]['name'] = $tempN;
             }
         }
     } 
     $aux = array();
     for( $i = 0; $i < 11 ; $i++ ){
         $aux[$i] = $result[$i];
     }
             
       return $this->render('TplFrontendBundle:Announce:announce-popular-categories.html.twig', array('subcategories' => $aux));
    }
    
    public function categoriesPopularSideBarAction()
    {
        $em = $this->get('doctrine')->getManager();
        
        $subcategories = $em->getRepository('AnnounceBundle:Subcategory')->findAll();
      
     foreach ($subcategories as $subcategory){         
          $sub = $em->getRepository('AnnounceBundle:Announce')->getPopularSubCategory($subcategory->getSubcategoryId());
          $result[] = array(
                'slug' => $subcategory->getSlug(),
                'name' => $subcategory->getName(),
                'cant' => count($sub)
            );      
     }
     
    for( $i = 1; $i < count($result) ; $i++ ){
         for( $j = 0; $j < count($result)-1; $j++ ){
             if($result[$j]['cant'] < $result[$j+1]['cant']){
                 $tempId = $result[$j]['slug'];
                 $tempC = $result[$j]['cant'];
                 $tempN = $result[$j]['name'];
                 $result[$j]['slug'] = $result[$j+1]['slug'];
                 $result[$j]['cant'] = $result[$j+1]['cant'];
                 $result[$j]['name'] = $result[$j+1]['name'];
                 $result[$j+1]['slug'] = $tempId;
                 $result[$j+1]['cant'] = $tempC;
                 $result[$j+1]['name'] = $tempN;
             }
         }
     }  
     $aux = array();
     for( $i = 0; $i < 20 ; $i++ ){
         $aux[$i] = $result[$i];
     }
             
       return $this->render('TplFrontendBundle:Sidebar:sidebar-left-categories.html.twig', array('categories' => $aux));
    }
}
