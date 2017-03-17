<?php

namespace NewsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Article_promo
 *
 * @ORM\Table(name="article_promo")
 * @ORM\Entity(repositoryClass="NewsBundle\Repository\Article_promoRepository")
 */
class Article_promo
{
    /**
     * @ORM\ManyToOne(targetEntity="NewsBundle\Entity\Promo", inversedBy="articles_promo")
     * @ORM\JoinColumn(nullable=false)
     */
    private $promo;

    /**
     * @ORM\OneToMany(targetEntity="NewsBundle\Entity\Commentaire_article_promo", mappedBy="article_promo", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $comments;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="createdAt", type="integer")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="string", length=255)
     */
    private $texte;

    /**
     * @var string
     *
     * @ORM\Column(name="src_feature", type="string", length=255)
     */
    private $srcFeature;



    public function __construct()
    {
        $this->createdAt = time();
        $this->comments= new ArrayCollection();
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
     * Get createdAt
     *
     * @return int
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Article_promo
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
     * Set texte
     *
     * @param string $texte
     *
     * @return Article_promo
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set srcFeature
     *
     * @param string $srcFeature
     *
     *
     * @return Article_promo
     */
    public function setSrcFeature($srcFeature)
    {
        $this->srcFeature = $srcFeature;

        return $this;
    }

    /**
     * Get srcFeature
     *
     * @return string
     */
    public function getSrcFeature()
    {
        return $this->srcFeature;
    }

    /**
     * Get promo
     *
     * @return Promo
     */
    public function getPromo()
    {
        return $this->promo;
    }

    /**
     * @param \NewsBundle\Entity\Promo $promo
     */
    public function setPromo($promo)
    {
        $this->promo = $promo;
    }

    function __toString()
    {
        return $this->titre;
    }

    /**
     * @return ArrayCollection|Commentaire_article_promo[]
     */
    public function getComments()
    {
        return $this->comments;
    }
}
