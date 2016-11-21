<?php

namespace Acme\FishBlockBundle\Controller;

use Acme\FishBlockBundle\AcmeFishBlockBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;


/**
 * Admin controller.
 *
 * @Route("admin")
 */
class AdminController extends Controller
{
    /**
     * Area Administration.
     *
     * @Route("/", name="_admin")
     * @Method("GET")
     */
    public function indexAction()
    {

        return $this->render('AcmeFishBlockBundle:admin:index_admin.html.twig');
    }



}

?>