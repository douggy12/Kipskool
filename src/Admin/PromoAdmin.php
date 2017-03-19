<?php

namespace Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;


class PromoAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Edition')
            ->add('nom', 'text')
            ->add('description', 'textarea')
            ->end()
            ->with('Ecole')
            ->add('ecole', 'entity', array(
                'class' => 'NewsBundle\Entity\Ecole',
                'choice_label' => 'nom',
            ))
            ->end()

        ;

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('nom');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nom')
            ->add('description');
    }


}