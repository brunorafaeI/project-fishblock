<?php

namespace Acme\FishBlockBundle\Controller;

use Acme\FishBlockBundle\Entity\Seasion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Seasion controller.
 *
 * @Route("admin/seasion")
 */
class SeasionController extends Controller
{
    /**
     * Lists all seasion entities.
     *
     * @Route("/", name="seasion_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $seasions = $em->getRepository('AcmeFishBlockBundle:Seasion')->findAll();

        return $this->render('AcmeFishBlockBundle:serie:seasion:index.html.twig', array(
            'seasions' => $seasions,
        ));
    }

    /**
     * Creates a new seasion entity.
     *
     * @Route("/new", name="seasion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $seasion = new Seasion();
        $form = $this->createForm('Acme\FishBlockBundle\Form\SeasionType', $seasion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($seasion);
            $em->flush($seasion);

            return $this->redirectToRoute('seasion_show', array('id' => $seasion->getId()));
        }

        return $this->render('AcmeFishBlockBundle:serie:seasion:new.html.twig', array(
            'seasion' => $seasion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a seasion entity.
     *
     * @Route("/{id}", name="seasion_show")
     * @Method("GET")
     */
    public function showAction(Seasion $seasion)
    {
        $deleteForm = $this->createDeleteForm($seasion);

        return $this->render('AcmeFishBlockBundle:serie:seasion:show.html.twig', array(
            'seasion' => $seasion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing seasion entity.
     *
     * @Route("/{id}/edit", name="seasion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Seasion $seasion)
    {
        $deleteForm = $this->createDeleteForm($seasion);
        $editForm = $this->createForm('Acme\FishBlockBundle\Form\SeasionType', $seasion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('seasion_edit', array('id' => $seasion->getId()));
        }

        return $this->render('AcmeFishBlockBundle:serie:seasion:edit.html.twig', array(
            'seasion' => $seasion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a seasion entity.
     *
     * @Route("/{id}", name="seasion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Seasion $seasion)
    {
        $form = $this->createDeleteForm($seasion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($seasion);
            $em->flush($seasion);
        }

        return $this->redirectToRoute('seasion_index');
    }

    /**
     * Creates a form to delete a seasion entity.
     *
     * @param Seasion $seasion The seasion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Seasion $seasion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('seasion_delete', array('id' => $seasion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
