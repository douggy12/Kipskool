<?php

namespace Kipskool\Bundle\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EcoleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('adresse')
            ->add('ville')
            ->add('pays')
            ->add('description')
            ->add('link')
            ->add('mail');

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'Kipskool\Bundle\NewsBundle\Entity\Ecole'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {

        return 'kipskool_bundle_newsbundle_ecole';
    }
}

