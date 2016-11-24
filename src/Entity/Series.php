<?php
//Acme/FishBlockBundle/Entity/Series.php

namespace Acme\FishBlockBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Series
 *
 * @ORM\Table(name="series")
 * @ORM\Entity(repositoryClass="Acme\FishBlockBundle\Repository\SerieRepository")
 */
class Series
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;


    /**
     * @var string
     *
     * @ORM\Column(type="string", length=120)
     */
    protected $titre;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=120)
     */
    protected $auteur;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=120)
     */
    protected $acteurs;

    /**
     * @var text
     *
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\OneToOne(targetEntity="Image")
     * @Assert\File(mimeTypes={ "image/jpg", "image/png", "image/jpeg" }, maxSize = "4096k")
     */
    protected $image;


    /**
     * @var \Category
     *
     * @ORM\ManyToOne(targetEntity="Category")
     *
     */
    protected $category;


    /**
     * @var \Seasion
     * @ORM\OneToMany(targetEntity="Seasion", mappedBy="serie")
     *
     */
    private $seasion;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->seasion = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set acteurs
     *
     * @param string $acteurs
     * @return Series
     */
    public function setActeurs($acteurs)
    {
        $this->acteurs = $acteurs;

        return $this;
    }

    /**
     * Get acteurs
     *
     * @return string
     */
    public function getActeurs()
    {
        return $this->acteurs;
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
     * @param \Acme\FishBlockBundle\Entity\Image $image
     * @return Series
     */
    public function setImage(\Acme\FishBlockBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Acme\FishBlockBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set category
     *
     * @param \Acme\FishBlockBundle\Entity\Category $category
     * @return Series
     */
    public function setCategory(\Acme\FishBlockBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Acme\FishBlockBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add seasion
     *
     * @param \Acme\FishBlockBundle\Entity\Seasion $seasion
     * @return Series
     */
    public function addSeasion(\Acme\FishBlockBundle\Entity\Seasion $seasion)
    {
        $this->seasion[] = $seasion;

        return $this;
    }

    /**
     * Remove seasion
     *
     * @param \Acme\FishBlockBundle\Entity\Seasion $seasion
     */
    public function removeSeasion(\Acme\FishBlockBundle\Entity\Seasion $seasion)
    {
        $this->seasion->removeElement($seasion);
    }

    /**
     * Get seasion
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSeasion()
    {
        return $this->seasion;
    }


    /**
     * Affichage d'une entité Serie avec echo
     * @return string Représentation de la série
     */
    public function __toString()
    {
        return array(
            $this->getImage(),
            $this->getTitre(),
            $this->getDescription(),
            $this->getCategory(),
            $this->getAuteur(),
            $this->getActeurs(),
            $this->getId()

        );
    }

}
