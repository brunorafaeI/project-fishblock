<?php

namespace Acme\FishBlockBundle\Controller;

use Acme\FishBlockBundle\Entity\Season;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Season controller.
 *
 * @Route("admin/season")
 */
class SeasonController extends Controller
{
    /**
     * Lists all season entities.
     *
     * @Route("/", name="season_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $seasons = $em->getRepository('AcmeFishBlockBundle:Season')->findAll();

        return $this->render('AcmeFishBlockBundle:season:index.html.twig', array(
            'seasons' => $seasons,
        ));
    }

    /**
     * Creates a new season entity.
     *
     * @Route("/new", name="season_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $season = new Season();
        $form = $this->createForm('Acme\FishBlockBundle\Form\SeasonType', $season);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($season);
            $em->flush($season);

            return $this->redirectToRoute('season_show', array('id' => $season->getId()));
        }

        return $this->render('AcmeFishBlockBundle:season:new.html.twig', array(
            'season' => $season,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a season entity.
     *
     * @Route("/{id}", name="season_show")
     * @Method("GET")
     */
    public function showAction(Season $season)
    {
        $deleteForm = $this->createDeleteForm($season);

        return $this->render('AcmeFishBlockBundle:season:show.html.twig', array(
            'season' => $season,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing season entity.
     *
     * @Route("/{id}/edit", name="season_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Season $season)
    {
        $deleteForm = $this->createDeleteForm($season);
        $editForm = $this->createForm('Acme\FishBlockBundle\Form\SeasonType', $season);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('season_edit', array('id' => $season->getId()));
        }

        return $this->render('AcmeFishBlockBundle:season:edit.html.twig', array(
            'season' => $season,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a season entity.
     *
     * @Route("/{id}", name="season_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Season $season)
    {
        $form = $this->createDeleteForm($season);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($season);
            $em->flush($season);
        }

        return $this->redirectToRoute('season_index');
    }

    /**
     * Creates a form to delete a season entity.
     *
     * @param Season $season The season entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Season $season)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('season_delete', array('id' => $season->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
