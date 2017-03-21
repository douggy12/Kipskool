<?php

namespace NewsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ArticlePerso
 *
 * @ORM\Table(name="article_perso")
 * @ORM\Entity(repositoryClass="NewsBundle\Repository\ArticlePersoRepository")
 */
class ArticlePerso
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
     * @ORM\Column(name="texte", type="string", length=10000)
     */
    private $texte;

    /**
     * @var string
     *
     * @ORM\Column(name="src_feature", type="string", length=255, nullable=true)
     */
    private $srcFeature;

    /**
     * @ORM\ManyToOne(targetEntity="NewsBundle\Entity\Perso", inversedBy="articles")
     *
     */
    private $perso;

    /**
     * @ORM\OneToMany(targetEntity="NewsBundle\Entity\CommentaireArticlePerso", mappedBy="article", cascade={"remove"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $commentaires;

    /**
     * @ORM\ManyToOne(targetEntity="NewsBundle\Entity\Perso")
     * @ORM\JoinColumn(nullable=true)
     */
    private $auteur;

    /**
     * @var string
     * @ORM\Column(name="type", type="string", length=16, nullable=true)
     */
    private $type;

    /**
     * ArticlePerso constructor
     */

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->createdAt =time();
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
     * Set titre
     *
     * @param string $titre
     *
     * @return ArticlePerso
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
     * @return ArticlePerso
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
     * @return ArticlePerso
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
     * @return Perso
     */
    public function getPerso()
    {
        return $this->perso;
    }

    /**
     * @param Perso $perso
     */
    public function setPerso(Perso $perso)
    {
        $this->perso = $perso;
    }

    /**
     * @return ArrayCollection|CommentaireArticlePerso[]
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * @return int
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }





    function __toString()
    {
        return $this->getTitre();
    }

    /**
     * @return Perso
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * @param Perso $auteur
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }






}

