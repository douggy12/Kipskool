<?php
namespace Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ArticlePersoAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper){
        $formMapper
            ->add('titre', 'text')
            ->add('texte', 'textarea')
            ->add('src_feature', 'text')
            ->add('perso', 'entity', array(
                'class'=>'NewsBundle\Entity\Perso',
                'choice_label'=>'nom'))
            ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper){
        $datagridMapper
            ->add('perso', null, array(), 'entity', array(
                'class'=> 'NewsBundle\Entity\Perso',
                'choice_label'=>'nom'
            ));
    }

    protected function configureListFields(ListMapper $listMapper){
        $listMapper
            ->addIdentifier('titre')
            ->add('createdAt', 'date', array(
                'pattern'=>'dd MM YYYY',
                'locale'=>'fr',
                'timezone'=>'Europe/Paris'
            ))
            ->add('perso.nom')
            ->add('texte');
    }
}