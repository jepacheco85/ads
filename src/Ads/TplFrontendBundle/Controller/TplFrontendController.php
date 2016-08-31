<?php

namespace Ads\TplFrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class TplFrontendController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render( 'TplFrontendBundle:TplFrontend:index.html.twig' );
    }

    public function indiceAction()
    {
        return $this->render( 'TplFrontendBundle:TplFrontend:indice.html.twig' );
    }

    /**
     * Accion que retorna la pagina del home.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homeAction()
    {
        $em = $this->get('doctrine')->getEntityManager();
        $categories = $em->getRepository('AnnounceBundle:Category')->findAll();
        $subcategories = $em->getRepository('AnnounceBundle:Subcategory')->findAll(); 
        
         return $this->render('TplFrontendBundle:TplFrontend:home.html.twig', array('categories' => $categories, 'subcategories' => $subcategories));        
    }

    public function loginAction()
    {
        return $this->render('TplFrontendBundle:Login:login.html.twig');
    }


    public function newPageAction()
    {
        return $this->render('TplFrontendBundle:TplFrontend:new-default.html.twig');
    }
    
    public function estaticaAction($page)
    {
    return $this->render('TplFrontendBundle:TplFrontend:'.$page.'.html.twig');
    }
}
