<?php
// src/Acme/FishBlockBundle/EventListener/ImageUploadListener.php
namespace Acme\FishBlockBundle\EventListener;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Acme\FishBlockBundle\FileUploader;
use Symfony\Component\HttpFoundation\File\File;


use Acme\FishBlockBundle\Entity\User;
use Acme\FishBlockBundle\Entity\Series;
use Acme\FishBlockBundle\Entity\Image;



class ImageUploadListener
{
    private $uploader;

    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    private function uploadFile($entity)
    {

        // upload only works for lited entities
        if ((!$entity instanceof User) OR (!$entity instanceof Series) OR (!$entity instanceof Image)) {
            return;
        }


        $file = $entity->getImage();

        // only upload new files
        if (!$file instanceof UploadedFile) {
            return;
        }

        $fileName = $this->uploader->upload($file);
        $entity->setImage($fileName);
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $fileName = $entity->getImage();

        $entity->setImage(new File($this->targetPath.'/'.$fileName));
    }

}