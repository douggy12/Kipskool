<?php
namespace Kipskool\Bundle\Admin;

use Kipskool\Bundle\NewsBundle\Entity\Promo;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PersoAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Perso')
            ->with('Utilisateur', array('class' => 'col-md-9'))
            ->add('nom', 'text')
            ->add('prenom', 'text')
            ->add('titre', 'text')
            ->add('born', DateType::class, array(
                'input' => 'timestamp',
                'widget' => 'single_text'))
            ->end()
            ->with('Role')
            ->add('role', 'entity', array(
                'class' => 'Kipskool\Bundle\NewsBundle\Entity\Role',
                'choice_label' => 'nom'))
            ->end()
            ->with('Compte')
            ->add('username', 'text')
            ->add('email','text')
            ->end()
            ->end()
            ->tab('Promo')
            ->with('Promo', array('class' => 'col-md-3'))
            ->add('promo', 'entity', array(
                'class' => 'Kipskool\Bundle\NewsBundle\Entity\Promo',
                'choice_label' => 'nom'))
            ->end()
            ->end();

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('promo', null, array(), 'entity', array(
                'class' => 'Kipskool\Bundle\NewsBundle\Entity\Promo',
                'choice_label' => 'nom'
            ));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nom')
            ->add('prenom')
            ->add('promo.nom')
            ->add('mail');
    }

}