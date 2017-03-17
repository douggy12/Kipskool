<?php

namespace NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommentaireArticlePerso
 *
 * @ORM\Table(name="commentaire_article_perso")
 * @ORM\Entity(repositoryClass="NewsBundle\Repository\CommentaireArticlePersoRepository")
 */
class CommentaireArticlePerso
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
     * @ORM\Column(name="texte", type="string", length=255)
     */
    private $texte;

    /**
     * @var string
     *
     * @ORM\Column(name="createdAt", type="string", length=255)
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="NewsBundle\Entity\ArticlePerso",inversedBy="commentaires")
     */
    private $article;

    /**
     * @var Perso
     * @ORM\ManyToOne(targetEntity="NewsBundle\Entity\Perso")
     * @ORM\JoinColumn(nullable=true)
     */
    private $auteur;

    /**
     * CommentaireArticlePerso constructor.

     */
    public function __construct()
    {
        $this->createdAt = time();
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
     * Set texte
     *
     * @param string $texte
     *
     * @return CommentaireArticlePerso
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
     * Get createdAt
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return ArticlePerso
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param mixed $article
     */
    public function setArticle($article)
    {
        $this->article = $article;
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







}

