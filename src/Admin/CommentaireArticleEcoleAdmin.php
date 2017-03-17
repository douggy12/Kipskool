<?php
namespace Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CommentaireArticleEcoleAdmin extends AbstractAdmin

{
    protected function configureFormFields(FormMapper $formMapper){
        $formMapper
            ->add('texte','textarea')
            ->add('articleEcole', 'entity', array(
                'class'=>'NewsBundle\Entity\articleEcole',
                'choice_label'=>'titre'
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper){
        $datagridMapper
            ->add('articleEcole', null, array(), 'entity', array(
                'class'=>'NewsBundle\Entity\articleEcole',
                'choice_label'=>'titre'
            ))
            ;
    }

    protected function configureListFields(ListMapper $listMapper){
        $listMapper
            ->addIdentifier('texte')
            ->add('createdAt', 'date', array(
                'pattern'=>'dd MM YYYY',
                'locale'=>'fr',
                'timezone'=>'Europe/Paris'
            ))
            ->add('articleEcole.titre')
        ;
    }
}