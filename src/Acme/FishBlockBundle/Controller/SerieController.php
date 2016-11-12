<?php

namespace Acme\FishBlockBundle\Controller;

use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\Test\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Acme\FishBlockBundle\Entity\Serie;
use Acme\FishBlockBundle\Form\SerieType;


/**
 * Serie controller.
 *
 * @Route("/serie")
 */
class SerieController extends Controller
{

    /**
     * Lists all Serie entities.
     *
     * @Route("/", name="serie")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeFishBlockBundle:Serie')->findAll();


        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Serie entity.
     *
     * @Route("/", name="serie_create")
     * @Method("POST")
     * @Template("AcmeFishBlockBundle:Admin:new_serie.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Serie();
//        $image = new Image();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->persist($entity->getImage());
            $em->flush();

            return $this->redirect($this->generateUrl('serie_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Serie entity.
     *
     * @param Serie $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Serie $entity)
    {
        $form = $this->createForm(new SerieType(), $entity, array(
            'action' => $this->generateUrl('serie_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Serie entity.
     *
     * @Route("/new", name="serie_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Serie();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Serie entity.
     *
     * @Route("/{id}", name="serie_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeFishBlockBundle:Serie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Serie entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Serie entity.
     *
     * @Route("/{id}/edit", name="serie_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeFishBlockBundle:Serie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Serie entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a form to edit a Serie entity.
     *
     * @param Serie $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Serie $entity)
    {
        $form = $this->createForm(new SerieType(), $entity, array(
            'action' => $this->generateUrl('serie_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));


        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Serie entity.
     *
     * @Route("/{id}", name="serie_update")
     * @Method("PUT")
     * @Template("AcmeFishBlockBundle:Serie:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeFishBlockBundle:Serie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Serie entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('serie_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Serie entity.
     *
     * @Route("/{id}", name="serie_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeFishBlockBundle:Serie')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Serie entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('serie'));
    }

    /**
     * Creates a form to delete a Serie entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('serie_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
            ;
    }



}
