<?php

namespace NewsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * articleEcole
 *
 * @ORM\Table(name="article_ecole")
 * @ORM\Entity(repositoryClass="NewsBundle\Repository\articleEcoleRepository")
 * @Vich\Uploadable()
 *
 */
class articleEcole
{
    /**
     * @ORM\ManyToOne(targetEntity="NewsBundle\Entity\Ecole", inversedBy="articles")
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
     * @ORM\Column(name="texte", type="string", length=999999999)
     */
    private $texte;

    /**
     * @var File
     * @Vich\UploadableField(mapping="articlePerso_image",fileNameProperty="imageName")
     * @ORM\Column(name="srcFeature", type="string", length=255,nullable=true)
     */
    private $srcFeature;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageName;

    /**
     * @ORM\OneToMany(targetEntity="NewsBundle\Entity\commentaireArticleEcole", mappedBy="article", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $comments;

    /**
     * @var Perso
     * @ORM\ManyToOne(targetEntity="NewsBundle\Entity\Perso")
     * @ORM\JoinColumn(nullable=false)
     */
    private $auteur;

    /**
     * @var string
     * @ORM\Column(name="type", type="string", length=255,nullable=false)
     */
    private $type;

    /**
     * articleEcole constructor.
     */
    public function __construct()
    {

        $this->createdAt = time();
        $this->commentaires = new ArrayCollection();
    }

//    /**
//     * @Assert\Callback
//     * @param ExecutionContextInterface $context
//     */
//    public function validate(ExecutionContextInterface $context)
//    {
//        if ($this->srcFeature != null){
//
//
//            if (! in_array($this->srcFeature->getMimeType(), array(
//                'image/jpeg',
//                'image/gif',
//                'image/png'
//            ))) {
//                $context
//                    ->buildViolation('Wrong file type (jpg,gif,png)')
//                    ->atPath('fileName')
//                    ->addViolation()
//                ;
//            }
//        }
//    }


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
     * @return ArticleEcole
     */
    public function setSrcFeature(File $image = null)
    {


        if ($image) {
            $this->srcFeature = $image;
            $this->setImageName($image->getFilename());
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

    /**
     * Set ecole
     *
     * @param \NewsBundle\Entity\Ecole $ecole
     *
     * @return articleEcole
     */
    public function setEcole(\NewsBundle\Entity\Ecole $ecole)
    {
        $this->ecole = $ecole;

        return $this;
    }

    /**
     * @return ArrayCollection|commentaireArticleEcole[]
     */
    public function getComments()
    {
        return $this->comments;
    }



    /**
     * Get ecole
     *
     * @return \NewsBundle\Entity\Ecole
     */
    public function getEcole()
    {
        return $this->ecole;
    }

    function __toString() {
        return $this->titre;

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
    public function getClassName()
    {
        return (new \ReflectionClass($this))->getShortName();

    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }




}
