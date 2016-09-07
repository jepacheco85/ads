<?php

namespace Ads\AnnounceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Ads\AnnounceBundle\Entity\Announce;
use Ads\AnnounceBundle\Form\AnnounceType; 
use Ads\AnnounceBundle\Repository\AnnounceRepository;
use Ads\UserBundle\Entity\Users;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class AnnounceController extends Controller
{
    public function postAdsAction()
    {
        $request = $this->get('request');
        $announce = new Announce();
        $formulario = $this->createForm(new AnnounceType(), $announce);
        $formulario->setData($announce);
        
        $em = $this->get('doctrine')->getEntityManager();
        $categories = $em->getRepository('AnnounceBundle:Category')->findAll();
        $subcategories = $em->getRepository('AnnounceBundle:Subcategory')->findAll();
        $states = $em->getRepository('AddressBundle:Province')->findAll();
        $localities = $em->getRepository('AddressBundle:City')->findAll();
        
        $subcategory = $em->getRepository('AnnounceBundle:Subcategory')->findOneBySubcategoryId(array('category' =>
                $request->request->get('category')));
        $locality = $em->getRepository('AddressBundle:City')->findOneById(array('state' =>
                $request->request->get('locality')));
        
        $post = new \DateTime();
        
        //echo $request->request->get('ads'); 
              
        if ($request->getMethod() == 'POST') {
            $formulario->bind($request);

            if ($formulario->isValid()) {
                if (true === $user = $this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
                 
                  $user_login = $this->container->get('security.context')->getToken()->getUser(); 
                  
                  $announce->upload();
                  $announce->setPost($post);
                  $announce->setLocality($locality);
                  $announce->setSubcategory($subcategory);
                  $announce->setUser($user_login);
                  $em->persist($announce);
                  $em->flush();

              return $this->redirect($this->generateUrl('announce_details', array(
                                'id' => $announce->getAnnounceId(),
                                'idCat' => $subcategory->getCategory()->getCategoryId(),
                                'categories' => $categories,
                                'subcategories' => $subcategories,
                                'states' => $states, 
                                'localities' => $localities,
                                'announce' => $announce,
                                'rutaCat' => $subcategory->getCategory()->getName())));
              }else{                
                
                if (null === $u = $em->getRepository('UserBundle:Users')->findOneBy(array('email' => $request->request->get('email')))){
                    
                $usuario = new Users();                
                $usuario->setSalt(md5(time()));
                
                 $usuario->setName($request->request->get('name')); 
                 $usuario->setlastName($request->request->get('lastname'));
                 $usuario->setCel($request->request->get('cel')); 
                 $usuario->setEmail($request->request->get('email')); 
                 
                 $usuario->setPassword($request->request->get('name'));

                $encoder = $this->get('security.encoder_factory')->getEncoder($usuario);
                $passwordCodificado = $encoder->encodePassword($usuario->getPassword(),$usuario->getSalt());
                $usuario->setPassword($passwordCodificado);                
                 

                // Guardar el nuevo usuario en la base de datos
                $em->persist($usuario);
                $em->flush();

                // Crear un mensaje flash para notificar al usuario que se ha registrado correctamente
                /*$this->get('session')->setFlash('info', '¡Enhorabuena! Te has registrado correctamente en Ads'
                );*/

                // Loguear al usuario automáticamente
                $token = new UsernamePasswordToken($usuario, $usuario->getPassword(), 'usuarios', $usuario->getRoles());
                $this->container->get('security.context')->setToken($token);
                
               
               
                $subcategory = $em->getRepository('AnnounceBundle:Subcategory')->findOneBySubcategoryId(array('category' =>
                $request->request->get('category')));                            
             
              $announce->upload();  
              $announce->setPost($post);
              $announce->setCity($locality);
              $announce->setSubcategory($subcategory);
              $announce->setUser($usuario);
              $em->persist($announce);
              $em->flush();

              return $this->redirect($this->generateUrl('announce_post_ads_success', array(
                                'id' => $announce->getAnnounceId(),
                                'idCat' => $subcategory->getCategory()->getCategoryId(),
                                'categories' => $categories,
                                'subcategories' => $subcategories, 
                                'states' => $states, 
                                'localities' => $localities,
                                'announce' => $announce,
                                'rutaCat' => $subcategory->getCategory()->getName())));
              }else{
                  $announce->upload();
                  $announce->setPost($post);
                  $announce->setCity($locality);
                  $announce->setSubcategory($subcategory);
                  $announce->setUser($u);
                  $em->persist($announce);
                  $em->flush();
                  
                  return $this->redirect($this->generateUrl('announce_post_ads_success_log', array(
                                'id' => $announce->getAnnounceId(),
                                'idCat' => $subcategory->getCategory()->getCategoryId(),
                                'categories' => $categories,
                                'subcategories' => $subcategories,
                                'states' => $states, 
                                'localities' => $localities,
                                'announce' => $announce,
                                'rutaCat' => $subcategory->getCategory()->getName())));
                }              
            }  
          }
       }
       return $this->render('TplFrontendBundle:Announce:post-ads.html.twig', array(
                     'form' => $formulario->createView(),
                     'categories' => $categories,
                     'subcategories' => $subcategories,
                     'states' => $states, 
                     'localities' => $localities
                   ));
    }
    
    public function postAdsSuccessAction($id)
    {
        $em = $this->get('doctrine')->getEntityManager();
        $categories = $em->getRepository('AnnounceBundle:Category')->findAll();
        $subcategories = $em->getRepository('AnnounceBundle:Subcategory')->findAll();
        $announce = $em->find('AnnounceBundle:Announce', $id);
        
        $subcateg = $em->getRepository('AnnounceBundle:Announce')->findBy(array('subcategory' => $announce->getSubcategory()));
        
        $idCat = $subcateg[0]->getSubcategory()->getCategory()->getCategoryId();        
        $rutaCat = $subcateg[0]->getSubcategory()->getCategory()->getName();
        
        return $this->render('TplFrontendBundle:Announce:post-ads-success.html.twig', array(
            'idCat' => $idCat,
            'categories' => $categories,
            'subcategories' => $subcategories,            
            'announce' => $announce,
            'rutaCat' => $rutaCat)); 
    }
    
    public function postAdsSuccessLogAction($id)
    {
        $em = $this->get('doctrine')->getEntityManager();
        $categories = $em->getRepository('AnnounceBundle:Category')->findAll();
        $subcategories = $em->getRepository('AnnounceBundle:Subcategory')->findAll();
        $announce = $em->find('AnnounceBundle:Announce', $id);
        
        $subcateg = $em->getRepository('AnnounceBundle:Announce')->findBy(array('subcategory' => $announce->getSubcategory()));
        
        $idCat = $subcateg[0]->getSubcategory()->getCategory()->getCategoryId();        
        $rutaCat = $subcateg[0]->getSubcategory()->getCategory()->getName();
        
        return $this->render('TplFrontendBundle:Announce:post-ads-success-log.html.twig', array(
            'idCat' => $idCat,
            'categories' => $categories,
            'subcategories' => $subcategories,            
            'announce' => $announce,
            'rutaCat' => $rutaCat)); 
    }
    
    public function announceSubCatListAction($subcategory)
    {
        $em = $this->get('doctrine')->getEntityManager();
        $categories = $em->getRepository('AnnounceBundle:Category')->findAll();
        $subcategories = $em->getRepository('AnnounceBundle:Subcategory')->findAll();
        $states = $em->getRepository('AddressBundle:Province')->findAll();
        $localities = $em->getRepository('AddressBundle:City')->findAll();
        $subcateg = $em->getRepository('AnnounceBundle:Subcategory')->findBy(array('slug' => $subcategory));        
        
            /*$dql = "SELECT a FROM AnnounceBundle:Announce WHERE subcategory "
            $announces = $em->getRepository('AnnounceBundle:Announce')->findBy(array('subcategory' =>
            $subcateg[0]->getSubcategoryId()), array('post'=>'ASC'));*/
        
        $query = $em->createQuery(
            'SELECT a
            FROM AnnounceBundle:Announce a
            WHERE a.subcategory = :subcategory')->setParameter('subcategory', $subcateg[0]->getSubcategoryId());    
        $announces = $query->getResult();
            
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($announces, $this->get('request')->query->
            get('page', 1) /*page number*/, 6 /*limit per page*/ );
        
        $data = json_encode($announces);
                
        return $this->render('TplFrontendBundle:Announce:announces-list.html.twig', array(
            'categories' => $categories,
            'subcategories' => $subcategories,            
            'announces' => $announces,
            'states' => $states, 
            'localities' => $localities,
            'pagination' => $pagination));
    }  
    
    public function announceLocationListAction($locality)
    {
        $em = $this->get('doctrine')->getEntityManager();
        $categories = $em->getRepository('AnnounceBundle:Category')->findAll();
        $subcategories = $em->getRepository('AnnounceBundle:Subcategory')->findAll();
        $states = $em->getRepository('AddressBundle:Province')->findAll();
        $localities = $em->getRepository('AddressBundle:City')->findAll();
        $locat = $em->getRepository('AddressBundle:City')->findBy(array('id' => $locality));        
        
            $announces = $em->getRepository('AnnounceBundle:Announce')->findBy(array('locality' =>
            $locat[0]->getId()), array('post'=>'ASC'));
            
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($announces, $this->get('request')->query->
            get('page', 1) /*page number*/, 9 /*limit per page*/ );    
        
        return $this->render('TplFrontendBundle:Announce:announces-list.html.twig', array(
            'categories' => $categories,
            'subcategories' => $subcategories,
            'announces' => $announces,
            'states' => $states, 
            'localities' => $localities,           
            'pagination' => $pagination));
    }  
    
    public function announceDetailsAction($id)
    {
        $em = $this->get('doctrine')->getEntityManager();
        $categories = $em->getRepository('AnnounceBundle:Category')->findAll();
        $subcategories = $em->getRepository('AnnounceBundle:Subcategory')->findAll();
        $announce = $em->find('AnnounceBundle:Announce', $id);
        
        $subcateg = $em->getRepository('AnnounceBundle:Announce')->findBy(array('subcategory' => $announce->getSubcategory()));
        
        $idCat = $subcateg[0]->getSubcategory()->getCategory()->getCategoryId();        
        $rutaCat = $subcateg[0]->getSubcategory()->getCategory()->getName();
        
        return $this->render('TplFrontendBundle:Announce:announce-details.html.twig', array(
            'idCat' => $idCat,
            'categories' => $categories,
            'subcategories' => $subcategories,            
            'announce' => $announce,
            'rutaCat' => $rutaCat)); 
    }  
    
    public function announceFeaturedAction()
    {
        $em = $this->get('doctrine')->getEntityManager();
        $categories = $em->getRepository('AnnounceBundle:Category')->findAll();
        $subcategories = $em->getRepository('AnnounceBundle:Subcategory')->findAll();
        
        $announces = $em->getRepository('AnnounceBundle:Announce')->getFeatured();          
                
        return $this->render('TplFrontendBundle:Announce:announce-featured.html.twig', array(
            'categories' => $categories,
            'subcategories' => $subcategories,            
            'announces' => $announces)); 
    }  
    
    public function searchCategoryLocalityAction()
    {
        $request = $this->get('request');
        $em = $this->get('doctrine')->getEntityManager();
        $categories = $em->getRepository('AnnounceBundle:Category')->findAll();
        $subcategories = $em->getRepository('AnnounceBundle:Subcategory')->findAll();
        
        $states = $em->getRepository('AddressBundle:State')->findAll();
        $localities = $em->getRepository('AddressBundle:City')->findAll();
        
        $subcategory = $em->getRepository('AnnounceBundle:Subcategory')->findOneBySubcategoryId(array('category' =>
                $request->request->get('category')));
        $locality = $em->getRepository('AddressBundle:City')->findOneById(array('state' =>
                $request->request->get('locality')));
        
        $announces = $em->getRepository('AnnounceBundle:Announce')->getCategoryLocality($subcategory, $locality);  

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($announces, $this->get('request')->query->
            get('page', 1) /*page number*/, 9 /*limit per page*/ );         
                
        return $this->render('TplFrontendBundle:Announce:announces-list.html.twig', array(
            'categories' => $categories,
            'subcategories' => $subcategories,            
            'announces' => $announces,
            'states' => $states, 
            'localities' => $localities,
            'pagination' => $pagination));
    } 
}
