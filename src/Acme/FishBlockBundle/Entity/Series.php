<?php

namespace Acme\FishBlockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Series
 *
 * @ORM\Table(name="series")
 * @ORM\Entity(repositoryClass="Acme\FishBlockBundle\Repository\SerieRepository")
 * @Vich\Uploadable
 */
class Series
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
     * @ORM\Column(name="titre", type="string", length=150)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=120, nullable=true)
     */
    private $auteur;

    /**
     * @var \Acteurs
     *
     * @ORM\OneToMany(targetEntity="Acteurs", mappedBy="serie", cascade={"persist", "remove"})
     */
    private $acteurs;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\File(mimeTypes={ "image/jpg", "image/png", "image/jpeg" }, maxSize = "4096k")
     */
    private $image;

    /**
     * @var \Season
     *
     * @ORM\OneToMany(targetEntity="Season", mappedBy="serie", cascade={"persist", "remove"})
     */
    private $season;


    /**
     * @var \Category
     *
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="serie", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    
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
        return $this->getTitre();
    }



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->acteurs = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set titre
     *
     * @param string $titre
     * @return Series
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
     * Set auteur
     *
     * @param string $auteur
     * @return Series
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Series
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

    /**
     * Set image
     *
     * @param string $image
     * @return Series
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
     * @return Series
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
     * Add acteurs
     *
     * @param \Acme\FishBlockBundle\Entity\Acteurs $acteurs
     * @return Series
     */
    public function addActeur(\Acme\FishBlockBundle\Entity\Acteurs $acteurs)
    {
        $this->acteurs[] = $acteurs;

        return $this;
    }

    /**
     * Remove acteurs
     *
     * @param \Acme\FishBlockBundle\Entity\Acteurs $acteurs
     */
    public function removeActeur(\Acme\FishBlockBundle\Entity\Acteurs $acteurs)
    {
        $this->acteurs->removeElement($acteurs);
    }

    /**
     * Get acteurs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActeurs()
    {
        return $this->acteurs;
    }

    /**
     * Add season
     *
     * @param \Acme\FishBlockBundle\Entity\Season $season
     * @return Series
     */
    public function addSeason(\Acme\FishBlockBundle\Entity\Season $season)
    {
        $this->season[] = $season;

        return $this;
    }

    /**
     * Remove season
     *
     * @param \Acme\FishBlockBundle\Entity\Season $season
     */
    public function removeSeason(\Acme\FishBlockBundle\Entity\Season $season)
    {
        $this->season->removeElement($season);
    }

    /**
     * Get season
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * Add category
     *
     * @param \Acme\FishBlockBundle\Entity\Category $category
     * @return Series
     */
    public function addCategory(\Acme\FishBlockBundle\Entity\Category $category)
    {
        $this->category[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \Acme\FishBlockBundle\Entity\Category $category
     */
    public function removeCategory(\Acme\FishBlockBundle\Entity\Category $category)
    {
        $this->category->removeElement($category);
    }

    /**
     * Get category
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
