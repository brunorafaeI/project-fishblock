<?php

namespace Acme\FishBlockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile as Assert;


/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity
 */
class Image
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var \Serie
     * @ORM\OneToOne(targetEntity="Serie", mappedBy="image")
     *
     */
    private $serie;



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
     * Set name
     *
     * @param string $description
     * @return Image
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Affichage d'une entité Serie avec echo
     * @return string Représentation du serie
     */
    public function __toString()
    {
        return $this->name;
    }




    /**
     * Set serie
     *
     * @param \Acme\FishBlockBundle\Entity\Serie $serie
     * @return Image
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
}
