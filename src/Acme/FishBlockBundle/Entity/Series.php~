<?php

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
     * @var string
     *
     * @ORM\Column(name="acteurs", type="string", length=120, nullable=true)
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
     * @ORM\Column(type="string", length=150, nullable=true)
     * @Assert\File(mimeTypes={ "image/jpg", "image/png", "image/jpeg" }, maxSize = "4096k")
     */
    private $image;

    /**
     * @var \Seasion
     *
     * @ORM\OneToMany(targetEntity="Seasion", mappedBy="serie")
     */
    private $seasion;


    /**
     * @var \Category
     *
     * @ORM\ManyToMany(targetEntity="Category", mappedBy="serie")
     */
    private $category;



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
        $this->seasion = new \Doctrine\Common\Collections\ArrayCollection();
        $this->category = new \Doctrine\Common\Collections\ArrayCollection();
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
