<?php

namespace Acme\FishBlockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @var string
     * @ORM\Column(type="string", length=150, nullable=true)
     * @Assert\File(mimeTypes={ "image/jpg", "image/png", "image/jpeg" }, maxSize = "4096k")
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;


    /**
     * @var \Category
     *
     * @ORM\OneToOne(targetEntity="Category")
     */
    protected $category;


    

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
     * Set category
     *
     * @param \Acme\FishBlockBundle\Entity\Category $category
     * @return Proposer
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
     * Affichage d'une entité Proposer avec echo
     * @return string Représentation du proposer
     */
    public function __toString()
    {
        return array(
            $this->getNomSerie(),
            $this->getImage(),
            $this->getCategory(),
            $this->getId()

        );
    }


}
