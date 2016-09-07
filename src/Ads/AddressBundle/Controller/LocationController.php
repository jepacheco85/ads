<?php

namespace Ads\AddressBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AddressBundle:Default:index.html.twig');
    }
}
