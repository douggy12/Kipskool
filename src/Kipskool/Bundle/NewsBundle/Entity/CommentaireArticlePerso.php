<?php

namespace Kipskool\Bundle\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommentaireArticlePerso
 *
 * @ORM\Table(name="commentaire_article_perso")
 * @ORM\Entity(repositoryClass="Kipskool\Bundle\NewsBundle\Repository\CommentaireArticlePersoRepository")
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
     * @ORM\ManyToOne(targetEntity="Kipskool\Bundle\NewsBundle\Entity\ArticlePerso",inversedBy="commentaires")
     */
    private $article;


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
     * Set createdAt
     *
     * @param string $createdAt
     *
     * @return CommentaireArticlePerso
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
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
}

