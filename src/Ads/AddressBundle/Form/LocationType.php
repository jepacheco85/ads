<?php

namespace Ads\AddressBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class AddressType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('locality', 'entity', array(
            'class' => 'Ads\\AddressBundle\\Entity\\Locality',
            'empty_value' => 'Seleccione...',
            'query_builder' => function (EntityRepository $repositorio) {
                return $repositorio->createQueryBuilder('l')->orderBy('l.id', 'ASC');
            }))    
             
            ->add('address')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ads\AddressBundle\Entity\Address'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ads_addressbundle_address';
    }
}
