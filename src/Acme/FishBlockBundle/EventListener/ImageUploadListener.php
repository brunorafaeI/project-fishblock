<?php
// src/Acme/FishBlockBundle/EventListener/ImageUploadListener.php
namespace Acme\FishBlockBundle\EventListener;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Acme\FishBlockBundle\FileUploader;
use Symfony\Component\HttpFoundation\File\File;


use Acme\FishBlockBundle\Entity\Episode;
use Acme\FishBlockBundle\Entity\Seasion;
use Acme\FishBlockBundle\Entity\Category;


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

        // upload only works for Serie entities
<<<<<<< HEAD
       if ($entity instanceof Category) {
           return;
       }
=======
        if (($entity instanceof Seasion) OR ($entity instanceof Episode) OR ($entity instanceof Category)) {
            return;
        }
>>>>>>> c7b8b7e6da045042cf9c25e3b9154f86d3ce194c


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