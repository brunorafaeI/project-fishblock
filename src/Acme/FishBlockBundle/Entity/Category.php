<?php

namespace Acme\FishBlockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="Acme\FishBlockBundle\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\Column(name="label", type="string", length=255, nullable=false, unique=true)
     */
    private $label;


    /**
     * @var \Serie
     * @ORM\OneToMany(targetEntity="Serie", mappedBy="category")
     *
     */
    private $serie;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->serie = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set label
     *
     * @param string $label
     * @return Category
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Add serie
     *
     * @param \Acme\FishBlockBundle\Entity\Serie $serie
     * @return Category
     */
    public function addSerie(\Acme\FishBlockBundle\Entity\Serie $serie)
    {
        $this->serie[] = $serie;

        return $this;
    }

    /**
     * Remove serie
     *
     * @param \Acme\FishBlockBundle\Entity\Serie $serie
     */
    public function removeSerie(\Acme\FishBlockBundle\Entity\Serie $serie)
    {
        $this->serie->removeElement($serie);
    }

    /**
     * Get serie
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Affichage d'une entité Film avec echo
     * @return string Représentation du film
     */
    public function __toString()
    {
        return $this->getLabel();
    }
}
