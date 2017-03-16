<?php


namespace Kipskool\Bundle\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('invitation', 'app_invitation_type')
            ->add('nom')
            ->add('prenom')
            ->add('born', DateType::class, array(
                'input' => 'timestamp',
                'widget' => 'single_text'
            ))
            ->add('password');

        ;
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'app_user_registration';
    }
}