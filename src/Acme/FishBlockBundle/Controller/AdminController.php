<?php

namespace Acme\FishBlockBundle\Controller;

use Acme\FishBlockBundle\AcmeFishBlockBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction()
    {
        /**
         * Comme @Template() est vide, il va chercher par défaut le fichier dans FishBlockBundle/Resources/views/Admin/index.html.twig
         */
        return $this->render('AcmeFishBlockBundle:Admin:index_admin.html.twig');
    }



}

?>