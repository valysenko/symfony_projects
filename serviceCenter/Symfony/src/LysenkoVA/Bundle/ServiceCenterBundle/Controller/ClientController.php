<?php

namespace LysenkoVA\Bundle\ServiceCenterBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use LysenkoVA\Bundle\ServiceCenterBundle\Entity\Client;
use LysenkoVA\Bundle\ServiceCenterBundle\Form\ClientType;

/**
 * Client controller.
 *
 * @Route("/admin/client")
 */
class ClientController extends Controller
{

    /**
     * Lists all Client entities.
     *
     * @Route("/", name="admin_client")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $clientService = $this->get('client_service');

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('LysenkoVAServiceCenterBundle:Client')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Client entity.
     *
     * @Route("/", name="admin_client_create")
     * @Method("POST")
     * @Template("LysenkoVAServiceCenterBundle:Client:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $clientService = $this->get('client_service');

        $entity = new Client();
        $form = $clientService->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_client_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }



    /**
     * Displays a form to create a new Client entity.
     *
     * @Route("/new", name="admin_client_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $clientService = $this->get('client_service');

        $entity = new Client();
        $form   = $clientService->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Client entity.
     *
     * @Route("/{id}", name="admin_client_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $clientService = $this->get('client_service');

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LysenkoVAServiceCenterBundle:Client')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Client entity.');
        }

        $deleteForm = $clientService->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Client entity.
     *
     * @Route("/{id}/edit", name="admin_client_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $clientService = $this->get('client_service');

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LysenkoVAServiceCenterBundle:Client')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Client entity.');
        }

        $editForm = $clientService->createEditForm($entity);
        $deleteForm = $clientService->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }


    /**
     * Edits an existing Client entity.
     *
     * @Route("/{id}", name="admin_client_update")
     * @Method("PUT")
     * @Template("LysenkoVAServiceCenterBundle:Client:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $clientService = $this->get('client_service');

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LysenkoVAServiceCenterBundle:Client')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Client entity.');
        }

        $deleteForm = $clientService->createDeleteForm($id);
        $editForm = $clientService->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_client_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Client entity.
     *
     * @Route("/{id}", name="admin_client_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $clientService = $this->get('client_service');

        $form = $clientService->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('LysenkoVAServiceCenterBundle:Client')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Client entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_client'));
    }

}
