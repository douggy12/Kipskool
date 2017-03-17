<?php

namespace Admin;


use NewsBundle\NewsBundle;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CommentairesArticlesPromoAdmin extends AbstractAdmin{

    protected function configureFormFields(FormMapper $formMapper){
        $formMapper
            ->add('texte', 'textarea')
            ->add('Article_promo', 'entity', array(
                'class' => 'NewsBundle\Entity\Article_promo',
                'choice_label' => 'titre'
            ))
        ;
    }

    protected  function configureDataGridFilters(DatagridMapper $datagridMapper){
        $datagridMapper
            ->add('texte')
            ->add('article_promo', null, array(), 'entity', array(
                'class' => 'NewsBundle\Entity\Article_promo',
                'choice_label' => 'titre',
            ))
            ;
    }

    protected function configureListFields(ListMapper $listMapper){
        $listMapper
            ->addIdentifier('texte')
            ->add('createdAt', 'date', array(
                'pattern' => 'MM dd Y G',

                'timezone' => 'Europe/Paris'
            ))
        ;

    }
}