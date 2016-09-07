<?php

namespace Ads\AddressBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    
    public function provincesAction(Request $request)
    {
        $country_id = $request->request->get('country_id');
        
        $em = $this->getDoctrine()->getManager();
        
        $provinces = $em->getRepository('AddressBundle:Province')->findByCountryId($country_id);
        
        var_dump($country_id);die;
        
        return new JsonResponse($provinces);
    }
    
    
    public function citiesAction(Request $request)
    {
        $province_id = $request->request->get('province_id');
        
        $em = $this->getDoctrine()->getManager();
        
        $cities = $em->getRepository('AddressBundle:City')->findByProvinceId($province_id);
        
        return new JsonResponse($cities);
    }
}
