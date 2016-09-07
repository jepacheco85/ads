<?php

namespace Ads\AddressBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Ads\AddressBundle\Model\Location;
use Ads\AddressBundle\Form\LocationType;
use Ads\AddressBundle\Entity\City;

class LocationController extends Controller
{   
     
    public function newLocationAction(Request $request)
    {
        $location = new Location();
        $form = $this->createForm(new LocationType(), $location);
        /*$form->handleRequest($request);
        if ($form->isValid()) {
            // do amazing things
            $flashBag = $this->get('session')->getFlashBag();
            $flashBag->add('smtc_success', 'Se ha creado una localización:');
            $flashBag->add('smtc_success', sprintf('Dirección: %s', $location->address));
            $flashBag->add('smtc_success', sprintf('Ciudad: %s', $location->city->getName()));
            return $this->redirect($this->generateUrl('examples_dependent_selects'));
        }
        /*return array(
            'form' => $form->createView()
        );*/
        return $this->render('TplFrontendBundle:Address:new-location.html.twig', array('form' => $form->createView()));
    }
    
    /**
     * @Route("/selects-dependientes/location/{slug}/edit", name="examples_dependent_selects_location_edit")
     * @ParamConverter("city", class="AddressBundle:City")
     * @Template("TplFrontendBundle:Address:edit-address.html.twig")
     */
    public function editLocationAction(City $city, Request $request)
    {
        $location = new Location();
        $location->address = sprintf("Calle X número %d", rand(1,100));
        $location->city = $city;
        $form = $this->createForm(new LocationType(), $location);
        $form->handleRequest($request);
        if ($form->isValid()) {
            // do amazing things
            $flashBag = $this->get('session')->getFlashBag();
            $flashBag->add('smtc_success', 'Se ha editado una localización:');
            $flashBag->add('smtc_success', sprintf('Dirección: %s', $location->address));
            $flashBag->add('smtc_success', sprintf('Ciudad: %s', $location->city->getName()));
            return $this->redirect($this->generateUrl('examples_dependent_selects'));
        }
        return array(
            'form' => $form->createView(),
            'city' => $city
        );
    }
}
