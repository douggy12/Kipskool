<?php

namespace NewsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ArticlePerso
 * @Vich\Uploadable()
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
     * @var File
     * @Vich\UploadableField(mapping="article_image",fileNameProperty="imageName")
     * @ORM\Column(name="src_feature", type="string", length=255, nullable=true)
     */
    private $srcFeature;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageName;


    /**
     * @Assert\Callback
     * @param ExecutionContextInterface $context
     */
    public function validate(ExecutionContextInterface $context)
    {
        if ($this->srcFeature != null){

        if (! in_array($this->srcFeature->getMimeType(), array(
            'image/jpeg',
            'image/gif',
            'image/png'
        ))) {
            $context
                ->buildViolation('Wrong file type (jpg,gif,png)')
                ->atPath('fileName')
                ->addViolation()
            ;
        }
        }

    }

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

    /**
     * @return string
     */
    public function getClassName()
    {
        return (new \ReflectionClass($this))->getShortName();

    }

    /**
     * @param string $imageName
     *
     * @return ArticlePerso
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set srcFeature
     *
     * @param File|$image
     *
     * @return ArticlePerso
     */
    public function setSrcFeature(File $image = null)
    {
        $this->srcFeature = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * Get srcFeature

     * @return File|null
     */
    public function getSrcFeature()
    {
        return $this->srcFeature;
    }






}

