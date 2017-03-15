<?php

namespace Kipskool\Bundle\NewsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Perso
 *
 * @ORM\Table(name="perso")
 * @ORM\Entity(repositoryClass="Kipskool\Bundle\NewsBundle\Repository\PersoRepository")
 */
class Perso
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;

    /**
     * @var int
     *
     * @ORM\Column(name="born", type="integer")
     */
    private $born;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="Kipskool\Bundle\NewsBundle\Entity\ArticlePerso", mappedBy="perso", cascade={"remove"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $articles;

    /**
     * @ORM\ManyToOne(targetEntity="Kipskool\Bundle\NewsBundle\Entity\Promo", inversedBy="persos")
     */
    private $promo;

    /**
     * @ORM\ManyToOne(targetEntity="Kipskool\Bundle\NewsBundle\Entity\Role", inversedBy="persos")
     */
    private $role;

    /**
     * Perso constructor
     */
    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    /**
     * @return ArrayCollection|ArticlePerso[]
     */
    public function getArticles()
    {
        return $this->articles;
    }




    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Perso
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Perso
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Perso
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Perso
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set born
     *
     * @param integer $born
     *
     * @return Perso
     */
    public function setBorn($born)
    {
        $this->born = $born;

        return $this;
    }

    /**
     * Get born
     *
     * @return int
     */
    public function getBorn()
    {
        return $this->born;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Perso
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    function __toString()
    {
        return $this->getPrenom().$this->getNom();
    }

    /**
     * @return Promo
     */
    public function getPromo()
    {
        return $this->promo;
    }

    /**
     * @param Promo $promo
     */
    public function setPromo($promo)
    {
        $this->promo = $promo;
    }

    /**
     * @return Role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param Role $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }




}

