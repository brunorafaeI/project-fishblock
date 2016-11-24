<?php

namespace Acme\FishBlockBundle\Controller;


use Acme\FishBlockBundle\AcmeFishBlockBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;


// Important to use these statemenets, the json response is optional for our response.
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="_index")
     * @Template()
     */
     public function indexAction()
     {
         $repo = $this->getDoctrine()->getRepository('AcmeFishBlockBundle:Series');
         $series = $repo->lastAddSerie();


         return $this->render('AcmeFishBlockBundle:accueil:index.html.twig', array('series' => $series));

     }

    /**
     * @Route("/series", name="_series", defaults={"label"=""})
     * @Route("/category/{label}", name="_category", defaults={"label"=""})
     * @Template()
     */
    public function listSeriesAction($label)
    {


        /* Tableau qui va stocker toutes les données à remplacer dans le template twig */
        $variables = array();

        // Récupération de l'entity manager qui va nous permettre de gérer les entités.
        $entityManager = $this->getDoctrine()->getManager();

        // On recherche dans la table Category l'enregistrement qui correspond au label reçut
        // par l'url et on stocke l'objet Category dans une variable
        $selectedCategory = $entityManager
            ->getRepository("AcmeFishBlockBundle:Category")
            ->findOneBy(array("label" => $label));

        if ($selectedCategory) {
            // Si le category passé par l'url existe bien, on passe l'id à notre template
            $variables['selected_category'] = $selectedCategory->getId();
        } else {
            // Sinon on renvoie 0, aucun category n'a été sélectionné
            $variables['selected_category'] = null;
        }

        // Récupération de la liste des series grâce à notre méthode findByCategory.
        $listeDeSeries = $entityManager
            ->getRepository("AcmeFishBlockBundle:Series")
            ->findByCategory($variables['selected_category']);

        $variables['series'] = $listeDeSeries;

        // On récupère le nombre total de series en comptant simplement le resultat de la recheche de tous les series
        $variables['total_nb_series'] = $entityManager->getRepository("AcmeFishBlockBundle:Series")->countAll();

        /* On récupère la liste des categorys avec le nombre de series associés pour notre sidebar */
        $variables['categorys'] = $entityManager
            ->getRepository('AcmeFishBlockBundle:Category')
            ->fetchAllWithSeriesCount();

        return $this->render('AcmeFishBlockBundle:Series:list_series.html.twig', $variables);

    }

    /**
     *
     * @Route("/serie/{label}", name="_serie_show", defaults={"label"=""})
     * @Template()
     */
    public function showSerieAction($label){

            $label = str_replace("-"," ",$label);
            $repo = $this->getDoctrine()->getRepository('AcmeFishBlockBundle:Series');
            $titre = $repo->findOneBy(array('titre' => $label));

            if($titre){
                $serie = $titre;
                return $this->render('AcmeFishBlockBundle:Series:show_serie.html.twig', ['serie' => $serie]);

            }


    }



       /**
       * @Route("/series/search", name="_series_search")
       * @Method("POST")
       */
    public function searchAction()
    {
        //On vérifie si la méthode est POST
        if($this->get('request')->getMethod() == 'POST')
        {
            //On prend la valeur passée pour le champ #search-fish
            //et puis, on trait cette valeur avec la fonction htmlspecialchars
            $search = $this->get('request')->get('search-fish');
            $search = htmlspecialchars($search);
            $repo = $this->get('doctrine')->getRepository('AcmeFishBlockBundle:Series');

            //On vérifie si la valeur existe
            if($search)
            {
                //Si elle existe, on appelle la méthode searchSerie dans le fichier SerieRepository
                //et on return le résultat.
                $series = $repo->searchSerie($search);
                return $this->render('AcmeFishBlockBundle:Series:search_series.html.twig', array('series' => $series));

            }
            else {
                return $this->indexAction();
            }


        }

    }

    /**
     * Change the locale for the current user
     *
     * @param String $language
     * @return array
     *
     * @Route("/{langue}", name="_langue")
     * @Template()
     */
    public function setLocaleAction($langue = null)
    {
        if($langue != null)
        {
            // On enregistre la langue en session
            $this->get('session')->set('_locale', $langue);
        }

        // on tente de rediriger vers la page d'origine
        $url = $this->container->get('request')->headers->get('referer');
        if(empty($url))
        {
            $url = $this->container->get('router')->generate('_index');
        }

        return new RedirectResponse($url);
    }


}
