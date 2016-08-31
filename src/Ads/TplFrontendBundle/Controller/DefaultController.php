<?php

namespace Ads\TplFrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TplFrontendBundle:Default:index.html.twig');
    }
}
