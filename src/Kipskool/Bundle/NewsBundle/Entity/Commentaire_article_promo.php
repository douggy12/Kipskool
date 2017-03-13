<?php

namespace Kipskool\Bundle\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire_article_promo
 *
 * @ORM\Table(name="Commentaire_article_promo")
 * @ORM\Entity(repositoryClass="Kipskool\Bundle\NewsBundle\Repository\Commentaire_article_promoRepository")
 */
class Commentaire_article_promo
{
    /**
     * @ORM\ManyToOne(targetEntity="Kipskool\Bundle\NewsBundle\Entity\Article_promo", inversedBy="comments")
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
     * @param \Kipskool\Bundle\NewsBundle\Entity\Article_promo $article_promo
     *
     * @return Commentaire_article_promo
     */
    public function setArticlePromo(\Kipskool\Bundle\NewsBundle\Entity\Article_promo $article_promo)
    {
        $this->article_promo = $article_promo;

        return $this;
    }

    /**
     * Get article_promo
     *
     * @return \Kipskool\Bundle\NewsBundle\Entity\Article_promo
     */
    public function getArticlePromo()
    {
        return $this->article_promo;
    }

}
