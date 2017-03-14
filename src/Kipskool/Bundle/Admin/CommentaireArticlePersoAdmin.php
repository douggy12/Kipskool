<?php
namespace Kipskool\Bundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CommentaireArticlePersoAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper){
        $formMapper
            ->add('texte', 'textarea')
            ->add('article', 'entity', array(
                'class'=>'Kipskool\Bundle\NewsBundle\Entity\ArticlePerso',
                'choice_label'=>'titre'));

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper){
        $datagridMapper->add('article', null, array(), 'entity', array(
            'class'=>'Kipskool\Bundle\NewsBundle\Entity\ArticlePerso',
            'choice_label'=>'titre'));
    }

    protected function configureListFields(ListMapper $listMapper){
        $listMapper
            ->addIdentifier('texte')
            ->add('createdAt', 'date', array(
                'pattern'=>'dd MM YYYY',
                'timezone'=>'Europe/Paris'
            ))
            ->add('article.titre');
    }
}