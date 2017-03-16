<?php

namespace Kipskool\Bundle\NewsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Perso
 *
 * @ORM\Table(name="perso")
 * @ORM\Entity(repositoryClass="Kipskool\Bundle\NewsBundle\Repository\PersoRepository")
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
     * @ORM\OneToMany(targetEntity="Kipskool\Bundle\NewsBundle\Entity\ArticlePerso", mappedBy="perso", cascade={"remove"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $articles;

    /**
     * @ORM\ManyToMany(targetEntity="Kipskool\Bundle\NewsBundle\Entity\Promo", inversedBy="persos", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $promo;

    /**
     * @ORM\OneToOne(targetEntity="Kipskool\Bundle\NewsBundle\Entity\Invitation")
     * @ORM\JoinColumn(referencedColumnName="code")
     * @Assert\NotNull(message="Your invitation is wrong", groups={"Registration"})
     */
    protected $invitation;


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
        return $this->getPrenom().$this->getNom();
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
     * @param \Kipskool\Bundle\NewsBundle\Entity\ArticlePerso $article
     *
     * @return Perso
     */
    public function addArticle(\Kipskool\Bundle\NewsBundle\Entity\ArticlePerso $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \Kipskool\Bundle\NewsBundle\Entity\ArticlePerso $article
     */
    public function removeArticle(\Kipskool\Bundle\NewsBundle\Entity\ArticlePerso $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * Add promo
     *
     * @param \Kipskool\Bundle\NewsBundle\Entity\Promo $promo
     *
     * @return Perso
     */
    public function addPromo(\Kipskool\Bundle\NewsBundle\Entity\Promo $promo)
    {
        $this->promo[] = $promo;

        return $this;
    }

    /**
     * Remove promo
     *
     * @param \Kipskool\Bundle\NewsBundle\Entity\Promo $promo
     */
    public function removePromo(\Kipskool\Bundle\NewsBundle\Entity\Promo $promo)
    {
        $this->promo->removeElement($promo);
    }

    public function setInvitation(Invitation $invitation)
    {
        $this->invitation = $invitation;
    }

    public function getInvitation()
    {
        return $this->invitation;
    }
}
