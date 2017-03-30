<?php

namespace NewsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Promo
 *
 * @ORM\Table(name="promo")
 * @ORM\Entity(repositoryClass="NewsBundle\Repository\PromoRepository")
 *
 */
class Promo
{

    /**
     * @ORM\OneToMany(targetEntity="NewsBundle\Entity\Article_promo", mappedBy="promo", cascade={"remove"})
     * @ORM\OrderBy({"createdAt" = "DESC"})
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $articles_promo;

    /**
     * @ORM\ManyToOne(targetEntity="NewsBundle\Entity\Ecole", inversedBy="promos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ecole;

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
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     *
     * @ORM\ManyToMany(targetEntity="NewsBundle\Entity\Perso", mappedBy="promo", cascade={"persist"})
     */
    private $persos;


    public function __construct()
    {
        $this->persos = new ArrayCollection();
        $this->articles_promo = new ArrayCollection();
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
     * @return Promo
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
     * Set description
     *
     * @param string $description
     *
     * @return Promo
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    function __toString()
    {
     return $this->nom;
    }

    /**
     * @return ArrayCollection|Article_promo[]
     */
    public function getArticles_promo()
    {
        return $this->articles_promo;
    }

    /**
     * @return \NewsBundle\Entity\Ecole
     */
    public function getEcole()
    {
        return $this->ecole;
    }

    /**
     * @param \NewsBundle\Entity\Ecole $ecole
     */
    public function setEcole(\NewsBundle\Entity\Ecole $ecole)
    {
        $this->ecole = $ecole;
    }

    /**
     * @return ArrayCollection|Perso[]
     */
    public function getPersos()
    {
        return $this->persos;
    }




}

