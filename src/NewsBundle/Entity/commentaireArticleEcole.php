<?php

namespace NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * commentaireArticleEcole
 *
 * @ORM\Table(name="commentaire_article_ecole")
 * @ORM\Entity(repositoryClass="NewsBundle\Repository\commentaireArticleEcoleRepository")
 */
class commentaireArticleEcole
{
    /**
     * @ORM\ManyToOne(targetEntity="NewsBundle\Entity\articleEcole", inversedBy="commentaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;
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
     * @var int
     * @ORM\Column(name="createdAt", type="integer")
     */
    private $createdAt;

    /**
     * @var Perso
     * @ORM\ManyToOne(targetEntity="NewsBundle\Entity\Perso")
     * @ORM\JoinColumn(nullable=true)
     */
    private $auteur;

    /**
     * commentaireArticleEcole constructor.

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
     * @return commentaireArticleEcole
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
     * @return int
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    /**
     * Set articleEcole
     *
     * @param \NewsBundle\Entity\articleEcole $article
     *
     * @return commentaireArticleEcole
     */
    public function setArticle(\NewsBundle\Entity\articleEcole $article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get articleEcole
     *
     * @return \NewsBundle\Entity\articleEcole
     */
    public function getArticle()
    {
        return $this->article;
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
