<?php

namespace Acme\FishBlockBundle\Controller;


use Acme\FishBlockBundle\Entity\Serie;
use Acme\FishBlockBundle\Entity\Category;
use Acme\FishBlockBundle\AcmeFishBlockBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


// Important to use these statemenets, the json response is optional for our response.
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="_index", defaults={"label"=""})
     * @Template()
     */
     public function indexAction($langue = null)
     {
         $repo = $this->getDoctrine()->getRepository('AcmeFishBlockBundle:Serie');
         $series = $repo->lastAddSerie();



        // Change langue
         if ($langue != null) {
             // On enregistre la langue en session
             $this->container->get('session')->set('_locale', $langue);
             $request = $this->container->get('request');
             $request->setLocale($langue);
             $locale = $request->getLocale();

             return $this->render('AcmeFishBlockBundle:Accueil:index.html.twig', array('locale' => $locale, 'series' => $series));

         }

         return $this->render('AcmeFishBlockBundle:Accueil:index.html.twig', array('series' => $series));

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
            ->getRepository("AcmeFishBlockBundle:Serie")
            ->findByCategory($variables['selected_category']);

        $variables['series'] = $listeDeSeries;

        // On récupère le nombre total de series en comptant simplement le resultat de la recheche de tous les series
        $variables['total_nb_series'] = $entityManager->getRepository("AcmeFishBlockBundle:Serie")->countAll();

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
            $repo = $this->getDoctrine()->getRepository('AcmeFishBlockBundle:Serie');
            $titre = $repo->findOneBy(array('titre' => $label));

            if($titre){
                $serie = $titre;
                return $this->render('AcmeFishBlockBundle:Series:show_serie.html.twig', ['serie' => $serie]);

            }


    }



       /**
       * @Route("/series/search", name="_series_search")
       * @Method("POST")
       * @Template()
       */
    public function rechercheAction()
    {
        if($this->get('request')->getMethod() == 'POST')
        {


            $search = $this->get('request')->get('search-fish');
            $search = htmlspecialchars($search);
            $repo = $this->get('doctrine')->getRepository('AcmeFishBlockBundle:Serie');

            if($search != '')
            {

                $query = $repo->CreateQueryBuilder("s")
                            ->where("s.titre LIKE :search")
                            ->orderBy("s.titre", "ASC")
                            ->setParameter("search", "%".$search."%")
                            ->getQuery();
                $series = $query->getResult();



                return $this->render('AcmeFishBlockBundle:Series:search_series.html.twig', array('series' => $series));



            }
            else {
                return $this->indexAction();
            }


        }

    }


}
