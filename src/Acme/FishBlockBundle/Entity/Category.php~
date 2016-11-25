<?php
//Acme/FishBlockBundle/Entity/Category.php

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
     * @var \Series
     * @ORM\ManyToMany(targetEntity="Series", inversedBy="category", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="series_id", referencedColumnName="id")
     *
     *
     */
    private $serie;



    /**
     * Affichage d'une entité Category avec echo
     * @return string Représentation de la category
     */
    public function __toString()
    {
        return $this->getLabel();
    }


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
     * @param \Acme\FishBlockBundle\Entity\Series $serie
     * @return Category
     */
    public function addSerie(\Acme\FishBlockBundle\Entity\Series $serie)
    {
        $this->serie[] = $serie;

        return $this;
    }

    /**
     * Remove serie
     *
     * @param \Acme\FishBlockBundle\Entity\Series $serie
     */
    public function removeSerie(\Acme\FishBlockBundle\Entity\Series $serie)
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
}
