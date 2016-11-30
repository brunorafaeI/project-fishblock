<?php
// src/Acme/FishBlockBundle/Entity/User.php

namespace Acme\FishBlockBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use FOS\MessageBundle\Model\ParticipantInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @Vich\Uploadable
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
     * @var string
     * @ORM\Column(type="string", nullable=true, length=255)
     * @Assert\File(mimeTypes={ "image/jpg", "image/png", "image/jpeg" }, maxSize = "4096k")
     */
    protected $image;

    /**
     * @Vich\UploadableField(mapping="_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

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
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
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

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return User
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add customers
     *
     * @param \Acme\FishBlockBundle\Entity\Customer $customers
     * @return User
     */
    public function addCustomer(\Acme\FishBlockBundle\Entity\Customer $customers)
    {
        $this->customers[] = $customers;

        return $this;
    }

    /**
     * Remove customers
     *
     * @param \Acme\FishBlockBundle\Entity\Customer $customers
     */
    public function removeCustomer(\Acme\FishBlockBundle\Entity\Customer $customers)
    {
        $this->customers->removeElement($customers);
    }
}
