<?php

namespace Acme\FishBlockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proposer
 *
 * @ORM\Table(name="proposer")
 * @ORM\Entity(repositoryClass="Acme\FishBlockBundle\Repository\ProposerRepository")
 */
class Proposer
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
     * @ORM\Column(name="nom_serie", type="string", length=150, nullable=true)
     */
    private $nomSerie;

    /**
     * Unidirectional
     *
     * @ORM\OneToOne(targetEntity="Genre")
     *
     */
    protected $listeDesGenres;


    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=150)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;


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
     * Set nomSerie
     *
     * @param string $nomSerie
     * @return Proposer
     */
    public function setNomSerie($nomSerie)
    {
        $this->nomSerie = $nomSerie;

        return $this;
    }

    /**
     * Get nomSerie
     *
     * @return string 
     */
    public function getNomSerie()
    {
        return $this->nomSerie;
    }

    /**
     * Set genre
     *
     * @param string $genre
     * @return Proposer
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string 
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Proposer
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
     * Set description
     *
     * @param string $description
     * @return Proposer
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
     * Set listeDesGenres
     *
     * @param \Acme\FishBlockBundle\Entity\Genre $listeDesGenres
     * @return Proposer
     */
    public function setListeDesGenres(\Acme\FishBlockBundle\Entity\Genre $listeDesGenres = null)
    {
        $this->listeDesGenres = $listeDesGenres;

        return $this;
    }

    /**
     * Get listeDesGenres
     *
     * @return \Acme\FishBlockBundle\Entity\Genre 
     */
    public function getListeDesGenres()
    {
        return $this->listeDesGenres;
    }
}
