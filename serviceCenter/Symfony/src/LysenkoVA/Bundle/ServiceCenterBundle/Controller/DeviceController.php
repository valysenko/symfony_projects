<?php

namespace LysenkoVA\Bundle\ServiceCenterBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use LysenkoVA\Bundle\ServiceCenterBundle\Entity\Device;
use LysenkoVA\Bundle\ServiceCenterBundle\Form\DeviceType;

/**
 * Device controller.
 *
 * @Route("/admin/device")
 */
class DeviceController extends Controller
{

    /**
     * Lists all Device entities.
     *
     * @Route("/", name="admin_device")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('LysenkoVAServiceCenterBundle:Device')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Device entity.
     *
     * @Route("/", name="admin_device_create")
     * @Method("POST")
     * @Template("LysenkoVAServiceCenterBundle:Device:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $deviceService = $this->get('device_service');

        $entity = new Device();
        $form = $deviceService->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_device_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }



    /**
     * Displays a form to create a new Device entity.
     *
     * @Route("/new", name="admin_device_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $deviceService = $this->get('device_service');

        $entity = new Device();
        $form   = $deviceService->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Device entity.
     *
     * @Route("/{id}", name="admin_device_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $deviceService = $this->get('device_service');

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LysenkoVAServiceCenterBundle:Device')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Device entity.');
        }

        $deleteForm = $deviceService->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Device entity.
     *
     * @Route("/{id}/edit", name="admin_device_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $deviceService = $this->get('device_service');

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LysenkoVAServiceCenterBundle:Device')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Device entity.');
        }

        $editForm = $deviceService->createEditForm($entity);
        $deleteForm = $deviceService->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }


    /**
     * Edits an existing Device entity.
     *
     * @Route("/{id}", name="admin_device_update")
     * @Method("PUT")
     * @Template("LysenkoVAServiceCenterBundle:Device:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $deviceService = $this->get('device_service');

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LysenkoVAServiceCenterBundle:Device')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Device entity.');
        }

        $deleteForm = $deviceService->createDeleteForm($id);
        $editForm = $deviceService->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_device_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Device entity.
     *
     * @Route("/{id}", name="admin_device_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $deviceService = $this->get('device_service');

        $form = $deviceService->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('LysenkoVAServiceCenterBundle:Device')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Device entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_device'));
    }


}
