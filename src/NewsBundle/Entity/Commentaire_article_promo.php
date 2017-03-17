<?php

namespace NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire_article_promo
 *
 * @ORM\Table(name="Commentaire_article_promo")
 * @ORM\Entity(repositoryClass="NewsBundle\Repository\Commentaire_article_promoRepository")
 */
class Commentaire_article_promo
{
    /**
     * @ORM\ManyToOne(targetEntity="NewsBundle\Entity\Article_promo", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article_promo;

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
     ** @ORM\Column(name="createdAt", type="integer")
     */
    private $createdAt;

    /**
     * Commentaire_article_promo constructor.

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
     * @return Commentaire_article_promo
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
     * Set article_promo
     *
     * @param \NewsBundle\Entity\Article_promo $article_promo
     *
     * @return Commentaire_article_promo
     */
    public function setArticlePromo(\NewsBundle\Entity\Article_promo $article_promo)
    {
        $this->article_promo = $article_promo;

        return $this;
    }

    /**
     * Get article_promo
     *
     * @return \NewsBundle\Entity\Article_promo
     */
    public function getArticlePromo()
    {
        return $this->article_promo;
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
        return $this->texte;
    }


}
