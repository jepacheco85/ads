<?php

namespace Infusion\UsersBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class AdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email')
            ->add('name', 'text')
            ->add('password', 'repeated', array(
                    'type' => 'password',
                    'options' => array(
                        'attr' => array(
                            'class' => 'password-field',
                            'min' => 6,
                            'max' => 255,
                        ),
                    ),
                    'required' => true,
                    'invalid_message' => 'The password fields must match.',
                    'first_options' => array('label' => 'Password'),
                    'second_options' => array('label' => 'Repeat Password'),
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Infusion\UsersBundle\Entity\Admin'
        ));
    }

    public function getName()
    {
        return 'infusion_backendbundle_admintype';
    }
}
