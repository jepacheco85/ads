<?php

namespace Ads\AnnounceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AnnounceBundle:Default:index.html.twig');
    }
}
