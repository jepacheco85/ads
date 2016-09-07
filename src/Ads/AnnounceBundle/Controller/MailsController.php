<?php

namespace Ads\AnnounceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MailsController extends Controller
{
    public function contactAdvertiserLoginAction($id)
    {
        $request = $this->get('request');
        $em = $this->get('doctrine')->getEntityManager();
        //$user = $this->container->get('security.context')->getToken()->getUser();
        //$user = $em->getRepository('UserBundle:Users')->findOneBy(array('userId' => $u->getUserId())); 
        
        $categories = $em->getRepository('AnnounceBundle:Category')->findAll();
        $subcategories = $em->getRepository('AnnounceBundle:Subcategory')->findAll();
        $states = $em->getRepository('AddressBundle:Province')->findAll();
        $localities = $em->getRepository('AddressBundle:Locality')->findAll();

        $announce = $em->getRepository('AnnounceBundle:Announce')->findOneBy(array('announceId' => $id)); 
        $user[] = array(
            'name' => $request->request->get('name'),
            'email' => $request->request->get('email'),
            'tele' => $request->request->get('tele'),
            'message' =>$request->request->get('message')
        );
        
        $to = $announce->getUser()->getEmail();
        $subject = 'Contacto por anuncio';
        $sender = $request->request->get('email');
        
        $message = \Swift_Message::newInstance()->setSubject($subject)->setFrom($sender)->setTo($to);
        
        //$logo = $message->embed(\Swift_Image::fromPath('bundles/frontend/images/logo_medcareinfusion_mail.png'));
        //$linea = $message->embed(\Swift_Image::fromPath('bundles/frontend/images/linea_hor.jpg'));

        $message->setBody($this->renderView("TplFrontendBundle:Mails:mail-contact-advertiser.html.twig",
            array(
            'user' => $user,   
            'announce' => $announce)))->setContentType('text/html');
        $this->get('mailer')->send($message);
        
        return $this->redirect($this->generateUrl('announce_details', array(
                                'id' => $id,
                                'idCat' => $announce->getSubcategory()->getCategory()->getCategoryId(),
                                'categories' => $categories,
                                'subcategories' => $subcategories,
                                'states' => $states, 
                                'localities' => $localities,
                                'announce' => $announce,
                                'rutaCat' => $announce->getSubcategory()->getCategory()->getName())));        
    }
    
    public function contactAdvertiserNoLoginAction($id)
    {
        $request = $this->get('request');
        $em = $this->get('doctrine')->getEntityManager();        
        
        $categories = $em->getRepository('AnnounceBundle:Category')->findAll();
        $subcategories = $em->getRepository('AnnounceBundle:Subcategory')->findAll();
        $states = $em->getRepository('AddressBundle:Province')->findAll();
        $localities = $em->getRepository('AddressBundle:Locality')->findAll();

        $announce = $em->getRepository('AnnounceBundle:Announce')->findOneBy(array('announceId' => $id));  
        $user[] = array(
            'name' => $request->request->get('name'),
            'email' => $request->request->get('email'),
            'tele' => $request->request->get('tele'),
            'message' =>$request->request->get('message')
        );
        
        $to = $announce->getUser()->getEmail();
        $subject = 'Contacto por anuncio';
        $sender =$request->request->get('email');
        
        $message = \Swift_Message::newInstance()->setSubject($subject)->setFrom($sender)->setTo($to);
        
        //$logo = $message->embed(\Swift_Image::fromPath('bundles/frontend/images/logo_medcareinfusion_mail.png'));
        //$linea = $message->embed(\Swift_Image::fromPath('bundles/frontend/images/linea_hor.jpg'));

        $message->setBody($this->renderView("TplFrontendBundle:Mails:mail-contact-advertiser.html.twig",
            array(
            'user' => $user,   
            'announce' => $announce)))->setContentType('text/html');
        $this->get('mailer')->send($message);
        
        return $this->redirect($this->generateUrl('announce_details', array(
                                'id' => $id,
                                'idCat' => $announce->getSubcategory()->getCategory()->getCategoryId(),
                                'categories' => $categories,
                                'subcategories' => $subcategories,
                                'states' => $states, 
                                'localities' => $localities,
                                'announce' => $announce,
                                'user' => $user,
                                'rutaCat' => $announce->getSubcategory()->getCategory()->getName())));        
    }
}
