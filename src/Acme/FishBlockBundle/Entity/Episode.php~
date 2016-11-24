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
     * @var \Seasion
     *
     * @ORM\ManyToOne(targetEntity="Seasion", inversedBy="episodes", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="seasion_id", referencedColumnName="id")
     */
    private $seasion;

    /**
     * @var String
     *
     * @ORM\ManyToOne(targetEntity="Series")
     *
     */
    protected $serie;


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
     * Set seasion
     *
     * @param \Acme\FishBlockBundle\Entity\Seasion $seasion
     * @return Episode
     */
    public function setSeasion(\Acme\FishBlockBundle\Entity\Seasion $seasion = null)
    {
        $this->seasion = $seasion;

        return $this;
    }

    /**
     * Get seasion
     *
     * @return \Acme\FishBlockBundle\Entity\Seasion
     */
    public function getSeasion()
    {
        return $this->seasion;
    }

    /**
     * Set serie
     *
     * @param \Acme\FishBlockBundle\Entity\Serie $serie
     * @return Episode
     */
    public function setSerie(\Acme\FishBlockBundle\Entity\Serie $serie = null)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * Get serie
     *
     * @return \Acme\FishBlockBundle\Entity\Serie
     */
    public function getSerie()
    {
        return $this->serie;
    }


    /**
     * Affichage d'une entité Proposer avec echo
     * @return string Représentation du proposer
     */
    public function __toString()
    {
        return array(
            $this->getTitre(),
            $this->getDescription(),
            $this->getSeasion(),
            $this->getSerie(),
            $this->getId()

        );
    }


}
