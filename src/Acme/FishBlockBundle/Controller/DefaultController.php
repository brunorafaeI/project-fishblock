<?php

namespace Acme\FishBlockBundle\Controller;


use Acme\FishBlockBundle\Entity\Serie;
use Acme\FishBlockBundle\Entity\Genre;
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
     public function IndexAction(){
         $repo = $this->getDoctrine()->getRepository('AcmeFishBlockBundle:Serie');
         $series = $repo->lastAjoutSerie();

         return $this->render('AcmeFishBlockBundle:Accueil:index.html.twig', ['series' => $series]);

    }



    /**
     * @Route("/series", name="_series", defaults={"label"=""})
     * @Route("/genre/{label}", name="_genre", defaults={"label"=""})
     * @Template()
     */
    public function listSeriesAction($label)
    {
        /* Tableau qui va stocker toutes les données à remplacer dans le template twig */
        $variables = array();

        // Récupération de l'entity manager qui va nous permettre de gérer les entités.
        $entityManager = $this->getDoctrine()->getManager();

        // On recherche dans la table Genre l'enregistrement qui correspond au label reçut
        // par l'url et on stocke l'objet Genre dans une variable
        $selectedGenre = $entityManager
            ->getRepository("AcmeFishBlockBundle:Genre")
            ->findOneBy(array("label" => $label));

        if ($selectedGenre) {
            // Si le genre passé par l'url existe bien, on passe l'id à notre template
            $variables['selected_genre'] = $selectedGenre->getId();
        } else {
            // Sinon on renvoie 0, aucun genre n'a été sélectionné
            $variables['selected_genre'] = null;
        }

        // Récupération de la liste des series grâce à notre méthode findByGenre.
        $listeDeSeries = $entityManager
            ->getRepository("AcmeFishBlockBundle:Serie")
            ->findByGenre($variables['selected_genre']);

        $variables['series'] = $listeDeSeries;

        // On récupère le nombre total de series en comptant simplement le resultat de la recheche de tous les series
        $variables['total_nb_series'] = $entityManager->getRepository("AcmeFishBlockBundle:Serie")->countAll();

        /* On récupère la liste des genres avec le nombre de series associés pour notre sidebar */
        $variables['genres'] = $entityManager
            ->getRepository('AcmeFishBlockBundle:Genre')
            ->fetchAllWithSeriesCount();

        return $this->render('AcmeFishBlockBundle:Series:list_series.html.twig', $variables);

    }







    //    /**
	//  * @Route("/search")
	//  */
	// public function searchAction(Request $request)
	// {
	//     $searchTerm = $request->query->get('search-fish');
	//     return $this->redirect($this->generateUrl('_search_fish', array(
	//         'searchFish' => $searchFish,
	//     )));
	// }

}
