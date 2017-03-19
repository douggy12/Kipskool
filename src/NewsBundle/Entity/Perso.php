<?php

namespace NewsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Perso
 *
 * @ORM\Table(name="perso")
 * @ORM\Entity(repositoryClass="NewsBundle\Repository\PersoRepository")
 */
class Perso extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;


    /**
     * @var int
     *
     * @ORM\Column(name="born", type="integer", nullable=true)
     */
    private $born;



    /**
     * @ORM\OneToMany(targetEntity="NewsBundle\Entity\ArticlePerso", mappedBy="perso", cascade={"remove"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $articles;

    /**
     * @ORM\ManyToMany(targetEntity="NewsBundle\Entity\Promo", inversedBy="persos", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $promo;


    /**
     * Perso constructor
     */
    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->promo = new ArrayCollection();
        parent::__construct();
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



    function __toString()
    {
        return $this->getPrenom().' '.$this->getNom();
    }


    /**
     * @return ArrayCollection|Promo[]
     */
    public function getPromo()
    {
        return $this->promo;
    }

    /**
     * @param ArrayCollection|Promo[] $promo
     */
    public function setPromo($promo)
    {
        $this->promo = $promo;
    }







    /**
     * Add article
     *
     * @param \NewsBundle\Entity\ArticlePerso $article
     *
     * @return Perso
     */
    public function addArticle(ArticlePerso $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \NewsBundle\Entity\ArticlePerso $article
     */
    public function removeArticle(ArticlePerso $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * Add promo
     *
     * @param \NewsBundle\Entity\Promo $promo
     *
     * @return Perso
     */
    public function addPromo(Promo $promo)
    {
        $this->promo[] = $promo;

        return $this;
    }

    /**
     * Remove promo
     *
     * @param \NewsBundle\Entity\Promo $promo
     */
    public function removePromo(Promo $promo)
    {
        $this->promo->removeElement($promo);
    }
}
