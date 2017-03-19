<?php
namespace Admin;

use NewsBundle\Entity\Promo;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PersoAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $roles = $container->getParameter('security.role_hierarchy.roles');

        $rolesChoices = self::flattenRoles($roles);


        $formMapper
            ->tab('Perso')
            ->with('Utilisateur', array('class' => 'col-md-9'))
            ->add('nom', 'text')
            ->add('prenom', 'text')
            ->add('born', DateType::class, array(
                'input' => 'timestamp',
                'widget' => 'single_text'))
            ->end()
            ->end()
            ->tab('Promo')
            ->with('Promo', array('class' => 'col-md-3'))
            ->add('promo', 'entity', array(
                'class' => 'NewsBundle\Entity\Promo',
                'expanded' =>true,
                'multiple' => true,
                'choice_label' => 'nom'))
            ->end()
            ->end()
            ->tab('Compte')
            ->with('Utilisateur')
            ->add('username', 'text')
            ->add('email','text')
            ->end()
            ->with('Role')
            ->add('roles', 'choice', array(
                'choices' => $rolesChoices,
                'multiple' => true))
            ->end()
            ->end()

        ;

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('promo', null, array(), 'entity', array(
                'class' => 'NewsBundle\Entity\Promo',
                'choice_label' => 'nom'
            ));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nom')
            ->add('prenom')
            ->add('promo', 'entity', array(
                'class' => 'Kipskool\Bundle\NewsBundle\Entity\Promo',
                'multiple' => true,
                'choice_label' => 'nom'))
            ->add('email');
    }
    /**
     * Turns the role's array keys into string <ROLES_NAME> keys.
     * @todo Move to convenience or make it recursive ? ;-)
     */
    protected static function flattenRoles($rolesHierarchy)
    {
        $flatRoles = array();
        foreach($rolesHierarchy as $roles) {

            if(empty($roles)) {
                continue;
            }

            foreach($roles as $role) {
                if(!isset($flatRoles[$role])) {
                    $flatRoles[$role] = $role;
                }
            }
        }

        return $flatRoles;
    }

}