<?php
//Acme/FishBlockBundle/Entity/Seasion.php

namespace Acme\FishBlockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seasion
 *
 * @ORM\Table(name="seasion")
 * @ORM\Entity(repositoryClass="Acme\FishBlockBundle\Repository\SeasionRepository")
 */
class Seasion
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
     * @ORM\Column(name="label", type="string", length=150)
     *
     */
    private $label;

    /**
     * @var \Series
     * @ORM\ManyToOne(targetEntity="Series", inversedBy="seasion", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="serie_id", referencedColumnName="id")
     *
     */
    private $serie;

    /**
     * @var \Episode
     *
     * @ORM\OneToMany(targetEntity="Episode", mappedBy="seasion")
     */
    private $episode;


    /**
     * Affichage d'une entité Proposer avec echo
     * @return string Représentation du proposer
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
        $this->episode = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Seasion
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
     * Set serie
     *
     * @param \Acme\FishBlockBundle\Entity\Series $serie
     * @return Seasion
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

    /**
     * Add episode
     *
     * @param \Acme\FishBlockBundle\Entity\Episode $episode
     * @return Seasion
     */
    public function addEpisode(\Acme\FishBlockBundle\Entity\Episode $episode)
    {
        $this->episode[] = $episode;

        return $this;
    }

    /**
     * Remove episode
     *
     * @param \Acme\FishBlockBundle\Entity\Episode $episode
     */
    public function removeEpisode(\Acme\FishBlockBundle\Entity\Episode $episode)
    {
        $this->episode->removeElement($episode);
    }

    /**
     * Get episode
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEpisode()
    {
        return $this->episode;
    }
}
