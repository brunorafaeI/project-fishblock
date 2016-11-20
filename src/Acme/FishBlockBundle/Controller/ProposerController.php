<?php

namespace Acme\FishBlockBundle\Controller;

use Acme\FishBlockBundle\Entity\Proposer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Proposer controller.
 *
 * @Route("/")
 */
class ProposerController extends Controller
{
    /**
     * Lists all proposer entities.
     *
     * @Route("/admin/proposer", name="proposer_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $proposers = $em->getRepository('AcmeFishBlockBundle:Proposer')->findAll();

        return $this->render('AcmeFishBlockBundle:proposer:index.html.twig', array(
            'proposers' => $proposers,
        ));
    }

    /**
     * Creates a new proposer entity.
     *
     * @Route("/proposer/new", name="proposer_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $proposer = new Proposer();
        $form = $this->createForm('Acme\FishBlockBundle\Form\ProposerType', $proposer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($proposer);
            $em->flush($proposer);

            return $this->redirectToRoute('proposer_show', array('id' => $proposer->getId()));
        }

        return $this->render('AcmeFishBlockBundle:proposer:new.html.twig', array(
            'proposer' => $proposer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a proposer entity.
     *
     * @Route("/prposer/{id}", name="proposer_show")
     * @Method("GET")
     */
    public function showAction(Proposer $proposer)
    {
        $deleteForm = $this->createDeleteForm($proposer);

        return $this->render('AcmeFishBlockBundle:proposer:show.html.twig', array(
            'proposer' => $proposer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing proposer entity.
     *
     * @Route("/proposer/{id}/edit", name="proposer_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Proposer $proposer)
    {

        $editForm = $this->createForm('Acme\FishBlockBundle\Form\ProposerType', $proposer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('proposer_edit', array('id' => $proposer->getId()));
        }

        return $this->render('AcmeFishBlockBundle:proposer:edit.html.twig', array(
            'proposer' => $proposer,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a proposer entity.
     *
     * @Route("/proposer/{id}", name="proposer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Proposer $proposer)
    {
        $form = $this->createDeleteForm($proposer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($proposer);
            $em->flush($proposer);
        }

        return $this->redirectToRoute('proposer_index');
    }

    /**
     * Creates a form to delete a proposer entity.
     *
     * @param Proposer $proposer The proposer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Proposer $proposer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('proposer_delete', array('id' => $proposer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
