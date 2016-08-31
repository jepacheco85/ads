<?php

namespace Ads\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

use Ads\UserBundle\Form\UserType, Ads\UserBundle\Entity\Users;


class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->get('doctrine')->getEntityManager();
        $categories = $em->getRepository('AnnounceBundle:Category')->findAll();
        $subcategories = $em->getRepository('AnnounceBundle:Subcategory')->findAll();       
        
        
        $user = $this->container->get('security.context')->getToken()->getUser();
        //$cant = $em->getRepository('AnnounceBundle:Announce')->findTotalOrderByUser($user);
                
        return $this->render(
               'TplFrontendBundle:TplFrontend:home.html.twig', array(
                   'categories' => $categories,
                   'subcategories' => $subcategories)
                );   
    }
    
    public function loginUserAction(Request $request)
    {
        $session = $request->getSession();
 
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } elseif( null !== $session && $session->has( SecurityContext::AUTHENTICATION_ERROR ) ) {
            $error = $session->get( SecurityContext::AUTHENTICATION_ERROR );
            $session->remove( SecurityContext::AUTHENTICATION_ERROR );

        }else {
            $error = '';
        }
        
        if( $error ){
            // Crear un mensaje flash para notificar al usuario error en login
            $this->get('session')->getFlashBag()->add('info', $error->getMessage());
        }
        
        $em = $this->get('doctrine')->getEntityManager();
        $categories = $em->getRepository('AnnounceBundle:Category')->findAll();
        $subcategories = $em->getRepository('AnnounceBundle:Subcategory')->findAll();     
        
        return $this->render(
               'TplFrontendBundle:UserAnnounce:login.html.twig', 
                array('categories' => $categories,
                      'subcategories' => $subcategories,
                      // last username entered by the user
                      'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                      'error'         => $error
                    )
                );
    }
    
    public function loginAdminAction(Request $request)
    {
        $session = $request->getSession();
 
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        
        
        
        $em = $this->get('doctrine')->getEntityManager();
        $categories = $em->getRepository('BusinessBundle:Category')->findAll();
        $subcategories = $em->getRepository('BusinessBundle:Subcategory')->findAll();

        return $this->render(
               'BackendBundle:Default:login.html.twig', 
                array('categories' => $categories,
                      'subcategories' => $subcategories,
                      // last username entered by the user
                      'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                      'error'         => $error,
                    )
                );
    } 
    
    
    public function logOutAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $session = $request->getSession()->clear();
        
        return $this->render('TplFrontendBundle:Default:login.html.twig');
    }
    
    public function signupAction()
    {
        $peticion = $this->getRequest();
        $em = $this->getDoctrine()->getEntityManager();
        $categories = $em->getRepository('AnnounceBundle:Category')->findAll();
        $subcategories = $em->getRepository('AnnounceBundle:Subcategory')->findAll();
        $usuario = new Users();
        
        $formulario = $this->createForm(new UserType(), $usuario);

        if ($peticion->getMethod() == 'POST') {
            $formulario->bind($peticion);
            
            if ($formulario->isValid()) {
                // Completar las propiedades que el usuario no rellena en el formulario
               $usuario->setSalt(md5(time()));
               $usuario->setPassword($peticion->request->get('pass'));
               
                $encoder = $this->get('security.encoder_factory')->getEncoder($usuario);
                $passwordCodificado = $encoder->encodePassword($usuario->getPassword(),$usuario->getSalt()
                );
                $usuario->setPassword($passwordCodificado);
                
                $usuario->subirFoto();

                // Guardar el nuevo usuario en la base de datos
                $em->persist($usuario);
                $em->flush();

                // Crear un mensaje flash para notificar al usuario que se ha registrado correctamente
                $this->get('session')->getFlashBag()->add('info', '¡Enhorabuena! Te has registrado correctamente en Ads');

                // Loguear al usuario automáticamente
                $token = new UsernamePasswordToken($usuario, $usuario->getPassword(), 'usuarios', $usuario->getRoles());
                $this->container->get('security.context')->setToken($token);

                return $this->redirect($this->generateUrl('tpl_frontend_homepage', 
                                      array('categories' => $categories,
                                            'subcategories' => $subcategories)));
            }
            // Crear un mensaje flash para notificar al usuario que introdujo un email existente.
            $this->get('session')->getFlashBag()->add('info', '¡Upsss! El email introducido ya existe en nuestro sistema, Ingrese.');
            return $this->render('TplFrontendBundle:UserAnnounce:login.html.twig');
        }

        return $this->render('TplFrontendBundle:UserAnnounce:sigup.html.twig', array('form' => $formulario->createView()));
    }
    
    public function profileAction()
    {
        $em = $this->get('doctrine')->getEntityManager();
        $categories = $em->getRepository('AnnounceBundle:Category')->findAll();
        $subcategories = $em->getRepository('AnnounceBundle:Subcategory')->findAll(); 
        
        $user = $this->container->get('security.context')->getToken()->getUser();
        
        $announces = $em->getRepository('AnnounceBundle:Announce')->getAnnouncesByUser($user);
        
        return $this->render('TplFrontendBundle:UserAnnounce:profile.html.twig', array(
            'user' => $user,
            'announces' => $announces));
    }
    
    public function profileByUserAction($u)
    {
        $em = $this->get('doctrine')->getEntityManager();
        $categories = $em->getRepository('AnnounceBundle:Category')->findAll();
        $subcategories = $em->getRepository('AnnounceBundle:Subcategory')->findAll(); 
        
        $user = $em->getRepository('UserBundle:Users')->findOneByUserId(array('userId' => $u));
        
        $announces = $em->getRepository('AnnounceBundle:Announce')->getAnnouncesByUser($user);
        
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($announces, $this->get('request')->query->
            get('page', 1) /*page number*/, 5 /*limit per page*/ );
        
        return $this->render('TplFrontendBundle:UserAnnounce:profile.html.twig', array(
            'user' => $user,
            'announces' => $announces,
            'pagination' => $pagination));
    }
    
    public function userAnnounceAction()
    {
        $em = $this->get('doctrine')->getEntityManager();
        $user = $this->container->get('security.context')->getToken()->getUser();
        
        $announces = $em->getRepository('AnnounceBundle:Announce')->getAnnouncesByUser($user);
        
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($announces, $this->get('request')->query->
            get('page', 1) /*page number*/, 5 /*limit per page*/ );
        
        return $this->render('TplFrontendBundle:UserAnnounce:user-announces.html.twig', array(
            'announces' => $announces,
            'pagination' => $pagination));
    } 
    
    public function __construct() {
        //Cargamos el componente de sesion en todos los metodos
        $this->session = new Session();
    }
    
}
