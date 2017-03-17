<?php

namespace NewsBundle\DataFixtures\ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use NewsBundle\Entity\Ecole;
use NewsBundle\Entity\Perso;
use NewsBundle\Entity\Promo;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $ecole = new Ecole();
        $ecole
            ->setNom('IMIE le mans')
            ->setAdresse('13 rue de la broutte')
            ->setVille('Le Mans')
            ->setPays('France')
            ->setDescription('Une école qui roxe du poney')
            ->setLink('www.imie.com')
            ->setMail('imie@imie.com');


        $promo = new Promo();
        $promo
            ->setNom('JMQDL 2016')
            ->setDescription('Une promo de roxxor')
            ->setEcole($ecole);

        $userManager = $this->container->get('fos_user.user_manager');
        $admin = new Perso();
        $admin->setUsername('admin');
        $admin->setEmail('email@email.com');
        $admin->setPlainPassword('admin');
        $admin->setEnabled(true);


        $admin->setRoles(array(
            'ROLE_ADMIN'
        ));
        $user = new Perso();
        $user
            ->setNom('Aldebaran')
            ->setPrenom('Benoit')
            ->setBorn(0)
            ->setEmail('mail@mail.com')
            ->setEnabled(true)
            ->setPlainPassword('user')
            ->setUsername('user')
            ;
        //$user->addPromo($promo);


        $userManager->updateUser($admin, true);
        $userManager->updateUser($user, true);






        $manager->persist($admin);
        $manager->persist($ecole);

        //$manager->persist($promo);
        $manager->persist($user);
        $manager->flush();
    }
}
