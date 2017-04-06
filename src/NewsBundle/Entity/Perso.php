<?php

namespace NewsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Perso
 * @Vich\Uploadable()
 * @ORM\Table(name="perso")
 * @ORM\Entity(repositoryClass="NewsBundle\Repository\PersoRepository")
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
     * @ORM\OneToMany(targetEntity="NewsBundle\Entity\ArticlePerso", mappedBy="perso", cascade={"remove"})
     * @ORM\OrderBy({"createdAt" = "DESC"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $articles;

    /**
     * @ORM\ManyToMany(targetEntity="NewsBundle\Entity\Promo", inversedBy="persos", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $promo;

    /**
     * @var File
     * @Vich\UploadableField(mapping="perso_image",fileNameProperty="avatarName")
     * @ORM\Column(name="avatar", type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatarName;


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
        return $this->getPrenom() . ' ' . $this->getNom();
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
     * @param \NewsBundle\Entity\ArticlePerso $article
     *
     * @return Perso
     */
    public function addArticle(ArticlePerso $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \NewsBundle\Entity\ArticlePerso $article
     */
    public function removeArticle(ArticlePerso $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * Add promo
     *
     * @param \NewsBundle\Entity\Promo $promo
     *
     * @return Perso
     */
    public function addPromo(Promo $promo)
    {
        $this->promo[] = $promo;

        return $this;
    }

    /**
     * Remove promo
     *
     * @param \NewsBundle\Entity\Promo $promo
     */
    public function removePromo(Promo $promo)
    {
        $this->promo->removeElement($promo);
    }

//    /**
//     * @Assert\Callback
//     * @param ExecutionContextInterface $context
//     */
//    public function validate(ExecutionContextInterface $context)
//    {
//        if ($this->avatar != null) {
//            if (!in_array($this->avatar->getMimeType(), array(
//                    'image/jpeg',
//                    'image/gif',
//                    'image/png'
//                )) or $this->getAvatar() == null
//            ) {
//                $context
//                    ->buildViolation('Wrong file type (jpg,gif,png)')
//                    ->atPath('fileName')
//                    ->addViolation();
//            }
//        }
//
//    }

    /**
     * Set avatar
     *
     * @param File|$image
     *
     * @return Perso
     */
    public function setAvatar(File $image = null)
    {



        if ($image) {
            $this->avatar = $image;
            $this->setAvatarName($image->getFilename());
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }


        return $this;
    }

    /**
     * Get avatar
     * @return File|null
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @return string|null
     */
    public function getAvatarName()
    {
        return $this->avatarName;
    }

    /**
     * @param string $avatarName
     * @return Perso
     */
    public function setAvatarName($avatarName)
    {
        $this->avatarName = $avatarName;

        return $this;
    }


}
