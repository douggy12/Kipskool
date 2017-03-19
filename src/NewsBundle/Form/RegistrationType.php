<?php

namespace NewsBundle\Form;


use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('born', DateType::class, array(
                'input' => 'timestamp',
                'widget' => 'single_text'
            ))
            ->add('promo', 'entity', array(
                'class' => 'NewsBundle\Entity\Promo',
                'expanded' =>true,
                'multiple' => true,
                'choice_label' => 'nom'))
            ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

}