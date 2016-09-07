<?php
namespace Ads\AddressBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Ads\AddressBundle\EventListener\AddCityFieldSubscriber;
use Ads\AddressBundle\EventListener\AddProvinceFieldSubscriber;
use Ads\AddressBundle\EventListener\AddCountryFieldSubscriber;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $propertyPathToCity = 'city';
        $builder
            ->addEventSubscriber(new AddCityFieldSubscriber($propertyPathToCity))
            ->addEventSubscriber(new AddProvinceFieldSubscriber($propertyPathToCity))
            ->addEventSubscriber(new AddCountryFieldSubscriber($propertyPathToCity))
        ;
        $builder
            ->add('address', 'text', array(
                  'label' => 'Calle'
            ))
        ;
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ads\AddressBundle\Model\Location'
        ));
    }
    
    public function getName()
    {
        return 'ads_location';
    }
}