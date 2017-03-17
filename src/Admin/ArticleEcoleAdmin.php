<?php
namespace Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ArticleEcoleAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper){
        $formMapper
            ->add('titre', 'text')
            ->add('texte', 'textarea')
            ->add('srcFeature', 'text')
            ->add('ecole', 'entity', array(
                'class'=> 'NewsBundle\Entity\Ecole',
                'choice_label'=>'nom'
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper){
        $datagridMapper
            ->add('titre')
            ->add('ecole', null, array(), 'entity', array(
                'class'=> 'NewsBundle\Entity\Ecole',
                'choice_label'=>'nom'
            ));
    }

    protected function configureListFields(ListMapper $listMapper){
        $listMapper
            ->addIdentifier('titre')
            ->add('texte')
            ->add('srcFeature')
            ->add('ecole.nom')
            ->add('createdAt', 'date', array(
                    'pattern'=>'dd MM YYYY',
                    'locale'=>'fr',
                    'timezone'=>'Europe/Paris'
            ))
        ;
    }
}