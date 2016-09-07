<?php

namespace Ads\AnnounceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AnnounceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')   
            ->add('type', 'choice', array('label' => "Type: ",
                      'choices' => array('2' => 'Seleccione','1' => 'Privado', '0' => 'Negocio'),
                      'expanded' => false,
                      'multiple' => false,
                      'required' => true,  
                      'attr' => array('class' => 'selecter-selected')                    
                    ))
            ->add('description', 'textarea')
            ->add('price')
            ->add('negotiable', 'checkbox', array('required' => false)) 
            ->add('imagenes', 'collection', array(
                    'type'      => 'file',
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'options'=>array(
                    'required'  => false)))
           ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ads\AnnounceBundle\Entity\Announce',
            'csrf_protection' => false,
            //'validation_groups' => false,
            //'csrf_field_name' => '_token',
        ));
    }

    public function getName()
    {
        return 'ads_announcebundle_announcetype';
    }
}
