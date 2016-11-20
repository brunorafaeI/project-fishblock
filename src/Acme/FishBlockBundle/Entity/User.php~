<?php
// src/Acme/FishBlockBundle/Entity/User.php

namespace Acme\FishBlockBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var String
     *
     * @ORM\Column(type="string", nullable=true, length=255)
     * @Assert\File(mimeTypes={ "image/jpg", "image/png", "image/jpeg" }, maxSize = "4096k")
     */
    protected $image;


    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="date_nais")
     */
    protected $date_nais;


    public function __construct()
    {


        parent::__construct();



    }

    /**
     * Set image
     *
     * @param string $image
     * @return User
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
     * Set date_nais
     *
     * @param \DateTime $dateNais
     * @return User
     */
    public function setDateNais($dateNais)
    {
        $this->date_nais = $dateNais;

        return $this;
    }

    /**
     * Get date_nais
     *
     * @return \DateTime 
     */
    public function getDateNais()
    {
        return $this->date_nais;
    }
}
