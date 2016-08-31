<?php

namespace Ads\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\IsTrue;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('name')
                ->add('lastname')
                ->add('cel')
                ->add('sex', 'choice', array('label' => "Sexo: ",
                      'choices' => array('2' => 'Seleccione','1' => 'Masculino', '0' => 'Femenino'),
                      'expanded' => false,
                      'multiple' => false,
                      'required' => true,  
                      'attr' => array('class' => 'selecter-selected')                    
                    ))
                
                             
                ->add('email', 'email', array("label" => "Correo electronico: ",
                    "required" => true,
                    "attr" => array('class' => 'form-control input-md', 'placeholder' => 'Email'))) 
                ->add('avatar', 'file', array(
                      'required' => false,
                      'data_class' => null))
                /*->add('acepto', 'checkbox', array(
                    'property_path' => false,
                    'constraints' => new IsTrue(array('message' => 'Please accept the terms and conditions in order to register')),
                    'label' => 'I agree'))
                ; 
        
        /*if (null == $options['data']->getUserId()) {
            $builder->add('acepto', 'checkbox', array('mapped' => false));

            $builder->addValidator(new CallbackValidator(function(FormInterface $form) {
                if ($form["acepto"]->getData() == false) {
                    $form->addError(new FormError('Debes aceptar las condiciones indicadas antes de poder añadir una nueva oferta'));
                }
            }));
        }*/;
    }    

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ads\UserBundle\Entity\Users',
        ));
    }

    public function getName()
    {
        return 'ads_userbundle_usertype';
    }
}
