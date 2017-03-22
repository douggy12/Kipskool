<?php
/**
 * Created by PhpStorm.
 * User: dmett
 * Date: 22/03/2017
 * Time: 09:50
 */

namespace NewsBundle\Form;



use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CodeType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('type', ChoiceType::class, array(
                'choices' => array(
                    'java' => 'java',
                    'html' => 'html',
                    'javascript' => 'javascript',
                    'PHP' => 'php',
                    'CSS' => 'css'
                )
            ))
            ->add('texte', HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $optionsResolver)
    {
        $optionsResolver->setDefaults(array(
            'data_class' => 'NewsBundle\Entity\articlePerso'
        ));
    }

    public function getBlockPrefix()
    {
        return 'newsbundle_articleecole';
    }
}