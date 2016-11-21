<?php

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
     * @ORM\OneToMany(targetEntity="Episode", mappedBy="category")
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="episodes", type="string", length=150)
     */
    private $episodes;


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
     * Set episodes
     *
     * @param string $episodes
     * @return Seasion
     */
    public function setEpisodes($episodes)
    {
        $this->episodes = $episodes;

        return $this;
    }

    /**
     * Get episodes
     *
     * @return string 
     */
    public function getEpisodes()
    {
        return $this->episodes;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->label = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add label
     *
     * @param \Acme\FishBlockBundle\Entity\Episode $label
     * @return Seasion
     */
    public function addLabel(\Acme\FishBlockBundle\Entity\Episode $label)
    {
        $this->label[] = $label;

        return $this;
    }

    /**
     * Remove label
     *
     * @param \Acme\FishBlockBundle\Entity\Episode $label
     */
    public function removeLabel(\Acme\FishBlockBundle\Entity\Episode $label)
    {
        $this->label->removeElement($label);
    }
}
