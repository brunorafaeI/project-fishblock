<?php
// src/Acme/FishBlockBundle/Entity/User.php

namespace Acme\FishBlockBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use FOS\MessageBundle\Model\ParticipantInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser implements ParticipantInterface
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


    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Customer", mappedBy="user")
     */
    protected $customers;

    /**
     * Add customers
     *
     * @param \Customer $customers
     * @return User
     */
    public function addCustomer(Customer $customers)
    {
        $this->customers[] = $customers;

        return $this;
    }

    /**
     * Remove customers
     *
     * @param \Customer $customers
     */
    public function removeCustomer(Customer $customers)
    {
        $this->customers->removeElement($customers);
    }

    /**
     * Get customers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCustomers()
    {
        return $this->customers;
    }


    public function __construct()
    {


        parent::__construct();
        $this->customers = new ArrayCollection();

    }

    /**
     * Get expiresAt
     *
     * @return \DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * Get credentials_expire_at
     *
     * @return \DateTime
     */
    public function getCredentialsExpireAt()
    {
        return $this->credentialsExpireAt;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return User
     */
    public function setImage(UploadedFile $image = null)
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
