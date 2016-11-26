<?php
namespace Acme\FishBlockBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as EasyAdminController;
//use Acme\FishBlockBundle\Entity\Article;
use Acme\FishBlockBundle\Entity\User;


class AdminController extends EasyAdminController
{
    /**
     * @Route("/admin/", name="admin")
     */
    public function indexAction(Request $request)
    {
        return parent::indexAction($request);
    }

    public function createNewUsersEntity()
    {
        return $this->container->get('fos_user.user_manager')->createUser();
    }

    public function prePersistUsersEntity(User $user)
    {
        $this->container->get('fos_user.user_manager')->updateUser($user, false);
    }

    public function preUpdateUsersEntity(User $user)
    {
        $this->container->get('fos_user.user_manager')->updateUser($user, false);
    }

    /*public function createNewUserEntity()
    {
        return $this->get('fos_user.user_manager')->createUser();
    }

    protected function prepareEditEntityForPersist($entity)
    {
        if ($entity instanceof User) {
            return $this->updateSlug($entity);
        }
    }

    protected function prepareNewEntityForPersist($entity)
    {
        if ($entity instanceof User) {
            return $this->updateSlug($entity);
        }
    }

    private function updateSlug($entity)
    {
        $slug = $this->get('app.slugger')->slugify($entity->getTitle());
        $entity->setSlug($slug);

        return $entity;
    }*/
}