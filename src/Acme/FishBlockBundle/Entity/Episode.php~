<?php
//Acme/FishBlockBundle/Entity/Episode.php

namespace Acme\FishBlockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Episode
 *
 * @ORM\Table(name="episode")
 * @ORM\Entity(repositoryClass="Acme\FishBlockBundle\Repository\EpisodeRepository")
 */
class Episode
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
     * @var text
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \Season
     *
     * @ORM\ManyToOne(targetEntity="Season", inversedBy="episode")
     * @ORM\JoinColumn(name="season_id", referencedColumnName="id")
     *
     */
    private $season;

    /**
     * @var \Series
     *
     * @ORM\ManyToOne(targetEntity="Series")
     *
     */
    protected $serie;

    /**
     * Affichage d'une entité Episode avec echo
     * @return string Représentation du episode
     */
    public function __toString()
    {
        return $this->getTitre();
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
     * @return Episode
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
     * Set description
     *
     * @param string $description
     * @return Episode
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
     * Set season
     *
     * @param \Acme\FishBlockBundle\Entity\Season $season
     * @return Episode
     */
    public function setSeason(\Acme\FishBlockBundle\Entity\Season $season = null)
    {
        $this->season = $season;

        return $this;
    }

    /**
     * Get season
     *
     * @return \Acme\FishBlockBundle\Entity\Season 
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * Set serie
     *
     * @param \Acme\FishBlockBundle\Entity\Series $serie
     * @return Episode
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
