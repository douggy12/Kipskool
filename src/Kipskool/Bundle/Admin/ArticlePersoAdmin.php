<?php
namespace Kipskool\Bundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ArticlePersoAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper){
        $formMapper
            ->add('titre', 'text')
            ->add('texte', 'textarea')
            ->add('src_feature', 'text')
            ->add('Perso', 'entity', array(
                'class'=>'Kipskool\Bundle\NewsBundle\Entity\Perso',
                'choice_label'=>'nom'));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper){
        $datagridMapper
            ->add('Perso', null, array(), 'entity', array(
                'class'=> 'Kipskool\Bundle\NewsBundle\Entity\Perso',
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