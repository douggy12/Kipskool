<?php
namespace Kipskool\Bundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class EcoleAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper){
        $formMapper
            ->add('nom', 'text')
            ->add('adresse', 'text')
            ->add('ville', 'text')
            ->add('pays', 'text')
            ->add('description','textarea')
            ->add('link', 'text')
            ->add('mail', 'text')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper){
        $datagridMapper
            ->add('nom')
            ->add('ville');
    }

    protected function configureListFields(ListMapper $listMapper){
        $listMapper
            ->addIdentifier('nom')
            ->add('adresse')
            ->add('ville')
            ->add('pays')
            ->add('description')
            ->add('link')
            ->add('mail')
        ;
    }
}