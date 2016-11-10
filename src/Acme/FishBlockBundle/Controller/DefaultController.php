<?php

namespace Acme\FishBlockBundle\Controller;

use Acme\FishBlockBundle\AcmeFishBlockBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="_index", defaults={"label"=""})
     * @Template()
     */
    public function ActionIndex(){
        return $this->render('AcmeFishBlockBundle:Accueil:index.html.twig');
    }

}
