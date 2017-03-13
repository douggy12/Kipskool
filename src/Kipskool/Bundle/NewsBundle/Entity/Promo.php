<?php

namespace Kipskool\Bundle\NewsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Promo
 *
 * @ORM\Table(name="promo")
 * @ORM\Entity(repositoryClass="Kipskool\Bundle\NewsBundle\Repository\PromoRepository")
 *
 */
class Promo
{

    /**
     * @ORM\OneToMany(targetEntity="Kipskool\Bundle\NewsBundle\Entity\Article_promo", mappedBy="promo", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $articles_promo;
    /**
     * @ORM\ManyToOne(targetEntity="Kipskool\Bundle\NewsBundle\Entity\Ecole", inversedBy="promos")
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


    public function __construct()
    {
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
     * @return \Kipskool\Bundle\NewsBundle\Entity\Ecole
     */
    public function getEcole()
    {
        return $this->ecole;
    }

    /**
     * @param \Kipskool\Bundle\NewsBundle\Entity\Ecole $ecole
     */
    public function setEcole(\Kipskool\Bundle\NewsBundle\Entity\Ecole $ecole)
    {
        $this->ecole = $ecole;
    }



}

