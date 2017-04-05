<?php

namespace NewsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Promo
 *
 * @ORM\Table(name="promo")
 * @ORM\Entity(repositoryClass="NewsBundle\Repository\PromoRepository")
 * @Vich\Uploadable()
 *
 */
class Promo
{

    /**
     * @ORM\OneToMany(targetEntity="NewsBundle\Entity\Article_promo", mappedBy="promo", cascade={"remove"})
     * @ORM\OrderBy({"createdAt" = "DESC"})
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $articles_promo;

    /**
     * @ORM\ManyToOne(targetEntity="NewsBundle\Entity\Ecole", inversedBy="promos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ecole;

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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     *
     * @ORM\ManyToMany(targetEntity="NewsBundle\Entity\Perso", mappedBy="promo", cascade={"persist"})
     */
    private $persos;

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


    public function __construct()
    {
        $this->persos = new ArrayCollection();
        $this->articles_promo = new ArrayCollection();
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
     * @return Promo
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
     * Set description
     *
     * @param string $description
     *
     * @return Promo
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    function __toString()
    {
        return $this->nom;
    }

    /**
     * @return ArrayCollection|Article_promo[]
     */
    public function getArticles_promo()
    {
        return $this->articles_promo;
    }

    /**
     * @return \NewsBundle\Entity\Ecole
     */
    public function getEcole()
    {
        return $this->ecole;
    }

    /**
     * @param \NewsBundle\Entity\Ecole $ecole
     */
    public function setEcole(\NewsBundle\Entity\Ecole $ecole)
    {
        $this->ecole = $ecole;
    }

    /**
     * @return ArrayCollection|Perso[]
     */
    public function getPersos()
    {
        return $this->persos;
    }

//
//    /**
//     * @Assert\Callback
//     * @param ExecutionContextInterface $context
//     */
//    public function validate(ExecutionContextInterface $context)
//    {
//        if ($this->avatar != null) {
//            if (!in_array($this->avatar->getMimeType(), array(
//                'image/jpeg',
//                'image/gif',
//                'image/png',
//                'text'
//            ))
//            ) {
//                $context
//                    ->buildViolation('Wrong file type (jpg,gif,png)')
//                    ->atPath('fileName')
//                    ->addViolation();
//            }
//        }
//    }

    /**
     * Set avatar
     *
     * @param File|$image
     *
     * @return Promo
     */
    public function setAvatar(File $image = null)
    {
        $this->avatar = $image;
        $this->setAvatarName($image->getFilename());

        if ($image) {
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
     * @return Promo
     */
    public function setAvatarName($avatarName)
    {
        $this->avatarName = $avatarName;

        return $this;
    }


}

