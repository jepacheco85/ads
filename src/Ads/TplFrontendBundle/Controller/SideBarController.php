<?php

namespace Ads\TplFrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Clase encargada de renderear cada uno de los distintos widgets del sidebar.
 *
 * Class SideBarController
 * @author  Web Kod3r <web.kod3r@gmail.com>
 * @package Ads\TplFrontendBundle\Controller
 */
class SideBarController extends Controller
{
    public function sideAction()
    {
        return $this->render('TplFrontendBundle:SideBar:sidebar.html.twig');
    }
} 
