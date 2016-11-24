<?php
// src/Acme/FishBlockBundle/Entity/Thread.php

namespace Acme\FishBlockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use FOS\MessageBundle\Entity\Thread as BaseThread;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Thread extends BaseThread
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @var \FOS\MessageBundle\Model\ParticipantInterface
     */
    protected $createdBy;

    /**
     * @ORM\OneToMany(
     *   targetEntity="Message",
     *   mappedBy="thread"
     * )
     * @var Message[]|Collection
     */
    protected $messages;

    /**
     * @ORM\OneToMany(
     *   targetEntity="ThreadMetadata",
     *   mappedBy="thread",
     *   cascade={"all"}
     * )
     * @var ThreadMetadata[]|Collection
     */
    protected $metadata;

    /**
     * @var String
     *
     * @ORM\Column(type="string", nullable=true, length=255)
     * @Assert\File(mimeTypes={ "image/jpg", "image/png", "image/jpeg" }, maxSize = "4096k")
     */
    protected $image;


    /**
     * Set image
     *
     * @param string $image
     * @return Thread
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
     * Remove messages
     *
     * @param \Acme\FishBlockBundle\Entity\Message $messages
     */
    public function removeMessage(\Acme\FishBlockBundle\Entity\Message $messages)
    {
        $this->messages->removeElement($messages);
    }

    /**
     * Add metadata
     *
     * @param \Acme\FishBlockBundle\Entity\ThreadMetadata $metadata
     * @return Thread
     */
    public function addMetadatum(\Acme\FishBlockBundle\Entity\ThreadMetadata $metadata)
    {
        $this->metadata[] = $metadata;

        return $this;
    }

    /**
     * Remove metadata
     *
     * @param \Acme\FishBlockBundle\Entity\ThreadMetadata $metadata
     */
    public function removeMetadatum(\Acme\FishBlockBundle\Entity\ThreadMetadata $metadata)
    {
        $this->metadata->removeElement($metadata);
    }

    /**
     * Get metadata
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMetadata()
    {
        return $this->metadata;
    }
}
