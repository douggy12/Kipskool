<?php

namespace Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ArticlesPromoAdmin extends AbstractAdmin{

    protected function configureFormFields(FormMapper $formMapper){
        $formMapper
            ->add('titre', 'text')
            ->add('texte','textarea')
            ->add('src_feature','text')
            ->add('Promo', 'entity', array(
                'class' => 'NewsBundle\Entity\Promo',
                'choice_label' => 'nom',
            ))
        ;

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper){
        $datagridMapper
            ->add('titre')
            ->add('promo', null, array(), 'entity', array(
                'class' => 'NewsBundle\Entity\Promo',
                'choice_label' => 'nom',
            ))
        ;

    }

    protected function configureListFields(ListMapper $listMapper){
        $listMapper
            ->addIdentifier('titre')
            ->add('promo.nom')
            ->add('createdAt', 'date', array(
                'pattern' => 'MM dd Y G',

                'timezone' => 'Europe/Paris'
            ))

        ;
    }
}