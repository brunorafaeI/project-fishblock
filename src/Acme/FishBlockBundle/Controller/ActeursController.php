<?php

namespace Acme\FishBlockBundle\Controller;

use Acme\FishBlockBundle\Entity\Acteurs;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Acteur controller.
 *
 * @Route("acteurs")
 */
class ActeursController extends Controller
{
    /**
     * Lists all acteur entities.
     *
     * @Route("/", name="acteurs_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $acteurs = $em->getRepository('AcmeFishBlockBundle:Acteurs')->findAll();

        return $this->render('AcmeFishBlockBundle:acteurs:index.html.twig', array(
            'acteurs' => $acteurs,
        ));
    }

    /**
     * Creates a new acteur entity.
     *
     * @Route("/new", name="acteurs_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $acteur = new Acteur();
        $form = $this->createForm('Acme\FishBlockBundle\Form\ActeursType', $acteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($acteur);
            $em->flush($acteur);

            return $this->redirectToRoute('acteurs_show', array('id' => $acteur->getId()));
        }

        return $this->render('AcmeFishBlockBundle:acteurs:new.html.twig', array(
            'acteur' => $acteur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a acteur entity.
     *
     * @Route("/{id}", name="acteurs_show")
     * @Method("GET")
     */
    public function showAction(Acteurs $acteur)
    {
        $deleteForm = $this->createDeleteForm($acteur);

        return $this->render('AcmeFishBlockBundle:acteurs:show.html.twig', array(
            'acteur' => $acteur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing acteur entity.
     *
     * @Route("/{id}/edit", name="acteurs_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Acteurs $acteur)
    {
        $deleteForm = $this->createDeleteForm($acteur);
        $editForm = $this->createForm('Acme\FishBlockBundle\Form\ActeursType', $acteur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('acteurs_edit', array('id' => $acteur->getId()));
        }

        return $this->render('AcmeFishBlockBundle:acteurs:edit.html.twig', array(
            'acteur' => $acteur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a acteur entity.
     *
     * @Route("/{id}", name="acteurs_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Acteurs $acteur)
    {
        $form = $this->createDeleteForm($acteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($acteur);
            $em->flush($acteur);
        }

        return $this->redirectToRoute('acteurs_index');
    }

    /**
     * Creates a form to delete a acteur entity.
     *
     * @param Acteurs $acteur The acteur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Acteurs $acteur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('acteurs_delete', array('id' => $acteur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
