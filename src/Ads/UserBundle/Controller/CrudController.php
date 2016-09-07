<?php

namespace Ads\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Ads\UserBundle\Entity\Users;
use Ads\UserBundle\Form\UserType;
use Ads\AddressBundle\Entity\Address;
use Ads\AddressBundle\Form\AddressType;

class CrudController extends Controller
{
    public function userProfileAction()
    {
        /*$em = $this->get('doctrine')->getEntityManager();
        $user = $this->container->get('security.context')->getToken()->getUser();
        //$user = $em->find('UserBundle:Users', $u->getUserId());
        $form = $this->createForm(new UserType(), $user);
        $form->setData($user);*/       
       
        /*$location = new Location();
        $form = $this->createForm(new LocationType(), $location);
        
        return $this->render('TplFrontendBundle:UserAnnounce:user-profile.html.twig', array(
            'form' => $form->createView()));*/
        
        return $this->render('TplFrontendBundle:UserAnnounce:user-profile.html.twig');
    } 
    
    public function userEditDetailsAction()
    {  
        $request = $this->get('request');
        $em = $this->get('doctrine')->getEntityManager();
        
        $u = $this->container->get('security.context')->getToken()->getUser();  
        $user = $em->find('UserBundle:Users', $u->getUserId());       
        
        $form = $this->createForm(new UserType(), $user);
        //$form->setData($user);
        
        if ($request->getMethod() == 'POST') {
            $fotoOriginal = $form->getData()->getAvatar();
            $form->bind($request);

            if ($form->isValid()) {
                if (null == $user->getAvatar()) {
                    // La foto original no se modifica, recuperar su ruta
                    $user->setAvatar($fotoOriginal);
                }else {
                    $user->subirFoto(); 
                    //unlink('/../../../../web/bundles/uploads/users'.$fotoOriginal);
                  } 
                    $em->persist($user);
                    $em->flush(); 

                    // Crear un mensaje flash para notificar al usuario que se ha registrado correctamente
                    $this->get('session')->getFlashBag()->add('info', '¡Enhorabuena! Haz actualizado tus datos de contacto.');    

                   return $this->redirect($this->generateUrl('user_profile')); 
                }
            }         

        return $this->render('TplFrontendBundle:UserAnnounce:user-profile-details.html.twig', array(
            'form' => $form->createView()));
    }  
    
    public function userEditPassAction()
    {  
        $request = $this->get('request');
        $em = $this->get('doctrine')->getEntityManager();
        
        $user = $this->container->get('security.context')->getToken()->getUser(); 
        
        
        if($request->request->get('pass') === $request->request->get('confirm')){
            $user->setSalt(md5(time()));
            $user->setPassword($request->request->get('pass'));
            
            $encoder = $this->get('security.encoder_factory')->getEncoder($user);
            $passwordCodificado = $encoder->encodePassword($user->getPassword(),$user->getSalt());
            $user->setPassword($passwordCodificado); 
                
            $em->persist($user);
            $em->flush();  
            
        // Crear un mensaje flash para notificar al usuario que ha cambiado el password correctamente
        $this->get('session')->getFlashBag()->add('info', '¡Enhorabuena! Haz cambiado tu contrasenna.');
        
        return $this->redirect($this->generateUrl('user_profile'));           
        }  
        // Crear un mensaje flash para notificar al usuario que se ha tenido error
        $this->get('session')->getFlashBag()->add('info', '¡Upsss! Ha habido un error al cambiar su contrasenna, intente de nuevo.'); 
        
        return $this->redirect($this->generateUrl('user_profile')); 
    }  
    
    public function userEditAddressAction()
    {  
        $request = $this->get('request');
        $em = $this->get('doctrine')->getEntityManager();
        
        $user = $this->container->get('security.context')->getToken()->getUser();
           $address = new Address(); 
           $form = $this->createForm(new AddressType(), $address);
           $form->setData($address);  
           
           if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {                
                
                   $address->setUser($user);
                   $em->persist($address);
                   $em->flush();
                   
            // Crear un mensaje flash para notificar al usuario que ha cambiado el password correctamente
            $this->get('session')->getFlashBag()->add('info', '¡Enhorabuena! Usted ha agregado una nueva direccion.');       
                  return $this->redirect($this->generateUrl('user_profile'));   
                
            }
          } 
             return $this->render('TplFrontendBundle:UserAnnounce:user-profile-address.html.twig', array(
            'form' => $form->createView()));
    }  
    
    public function userDelAddressAction($id)
    {  
        $request = $this->get('request');
        $em = $this->get('doctrine')->getEntityManager();
        
        $user = $this->container->get('security.context')->getToken()->getUser();
        
        
        if (null == ($address = $em->find('AddressBundle:Address', $id))) {
            throw new NotFoundHttpException('No existe la direccion que intenta eliminar.');
        } else {
            $address = $em->find('AddressBundle:Address', $id);
            $em->remove($address);
            $em->flush();
            
            // Crear un mensaje flash para notificar al usuario que ha eliminado una direccion
            $this->get('session')->getFlashBag()->add('info', '¡Enhorabuena! Haz eliminado tu direccion.');
            return $this->redirect($this->generateUrl('user_profile'));
        }
        
           return $this->redirect($this->generateUrl('user_profile'));
    }  
    
    public function __construct() {
        //Cargamos el componente de sesion en todos los metodos
        $this->session = new Session();
    }
    
}
