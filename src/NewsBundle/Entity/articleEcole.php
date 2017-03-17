<?php

namespace Kipskool\Bundle\NewsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * articleEcole
 *
 * @ORM\Table(name="article_ecole")
 * @ORM\Entity(repositoryClass="Kipskool\Bundle\NewsBundle\Repository\articleEcoleRepository")
 *
 */
class articleEcole
{
    /**
     * @ORM\ManyToOne(targetEntity="Kipskool\Bundle\NewsBundle\Entity\Ecole", inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ecole;
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    private $extrait;
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
     * @ORM\Column(name="srcFeature", type="string", length=255)
     */
    private $srcFeature;

    /**
     * @ORM\OneToMany(targetEntity="Kipskool\Bundle\NewsBundle\Entity\commentaireArticleEcole", mappedBy="articleEcole", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $commentaires;

    /**
     * articleEcole constructor.
     */
    public function __construct()
    {

        $this->createdAt = time();
        $this->commentaires = new ArrayCollection();
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
     * @return articleEcole
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
     * @return articleEcole
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
     * @return articleEcole
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
     * Set ecole
     *
     * @param \Kipskool\Bundle\NewsBundle\Entity\Ecole $ecole
     *
     * @return articleEcole
     */
    public function setEcole(\Kipskool\Bundle\NewsBundle\Entity\Ecole $ecole)
    {
        $this->ecole = $ecole;

        return $this;
    }

    /**
     * @return ArrayCollection|commentaireArticleEcole[]
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }



    /**
     * Get ecole
     *
     * @return \Kipskool\Bundle\NewsBundle\Entity\Ecole
     */
    public function getEcole()
    {
        return $this->ecole;
    }

    function __toString() {
        return $this->titre;

}}
