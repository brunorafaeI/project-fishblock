<?php

namespace Acme\FishBlockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Acteurs
 *
 * @ORM\Table(name="acteurs")
 * @ORM\Entity(repositoryClass="Acme\FishBlockBundle\Repository\ActeursRepository")
 * @Vich\Uploadable
 */
class Acteurs
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
     * @ORM\Column(name="name", type="string", length=150)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="pseudo", type="string", length=150)
     */
    private $pseudo;

    /**
     * @var string
     *
     * @ORM\Column(name="resume", type="text", nullable=true)
     */
    private $resume;

    /**
     * @var \Series
     * @ORM\ManyToOne(targetEntity="Series", inversedBy="acteurs")
     * @ORM\JoinColumn(name="serie_id", referencedColumnName="id")
     *
     */
    private $serie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_nais", type="datetime", nullable=true)
     */
    private $dateNais;

    /**
     * @var float
     *
     * @ORM\Column(name="taille", type="float", nullable=true)
     */
    private $taille;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\File(mimeTypes={ "image/jpg", "image/png", "image/jpeg" }, maxSize = "4096k")
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Affichage d'une entité Serie avec echo
     * @return string Représentation de la série
     */
    public function __toString()
    {
        return $this->getName();
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Acteurs
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set pseudo
     *
     * @param string $pseudo
     * @return Acteurs
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string 
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set resume
     *
     * @param string $resume
     * @return Acteurs
     */
    public function setResume($resume)
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * Get resume
     *
     * @return string 
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * Set dateNais
     *
     * @param \DateTime $dateNais
     * @return Acteurs
     */
    public function setDateNais($dateNais)
    {
        $this->dateNais = $dateNais;

        return $this;
    }

    /**
     * Get dateNais
     *
     * @return \DateTime 
     */
    public function getDateNais()
    {
        return $this->dateNais;
    }

    /**
     * Set taille
     *
     * @param float $taille
     * @return Acteurs
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * Get taille
     *
     * @return float 
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Acteurs
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Acteurs
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set serie
     *
     * @param \Acme\FishBlockBundle\Entity\Series $serie
     * @return Acteurs
     */
    public function setSerie(\Acme\FishBlockBundle\Entity\Series $serie = null)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * Get serie
     *
     * @return \Acme\FishBlockBundle\Entity\Series 
     */
    public function getSerie()
    {
        return $this->serie;
    }
}
