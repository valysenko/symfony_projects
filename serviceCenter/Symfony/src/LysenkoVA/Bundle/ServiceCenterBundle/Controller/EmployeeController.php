<?php

namespace LysenkoVA\Bundle\ServiceCenterBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use LysenkoVA\Bundle\ServiceCenterBundle\Entity\Employee;
use LysenkoVA\Bundle\ServiceCenterBundle\Form\EmployeeType;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

/**
 * Employee controller.
 *
 * @Route("/admin/employee")
 */
class EmployeeController extends Controller
{

    /**
     * Lists all Employee entities.
     *
     * @Route("/", name="admin_employee")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('LysenkoVAServiceCenterBundle:Employee')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Lists all Employee entities.
     *
     * @Route("/department/{id}", name="admin_employee_by_departments")
     * @Method("GET")
     * @Template("LysenkoVAServiceCenterBundle:Employee:index.html.twig")
     */
    public function employeesOfDepartmentAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $department = $em->getRepository('LysenkoVAServiceCenterBundle:Department')->find($id);
        $entities = $em->getRepository('LysenkoVAServiceCenterBundle:Employee')->findBy(
            array(
                'department'=>$department,
            )
        );
        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Employee entity.
     *
     * @Route("/", name="admin_employee_create")
     * @Method("POST")
     * @Template("LysenkoVAServiceCenterBundle:Employee:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Employee();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

         $entity->setSalt(md5(time()));
         $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
         $password = $encoder->encodePassword('1', $entity->getSalt());
         $entity->setPassword($password);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $formEntity = $form->getData();
            $entity->setRoles($formEntity->getRoles()[0][0]);
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('cabinet'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Employee entity.
     *
     * @param Employee $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Employee $entity)
    {
        $form = $this->createForm(new EmployeeType(), $entity, array(
            'action' => $this->generateUrl('admin_employee_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Employee entity.
     *
     * @Route("/new", name="admin_employee_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Employee();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Employee entity.
     *
     * @Route("/{id}", name="admin_employee_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LysenkoVAServiceCenterBundle:Employee')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Employee entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Employee entity.
     *
     * @Route("/{id}/edit", name="admin_employee_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LysenkoVAServiceCenterBundle:Employee')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Employee entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->remove('roles');
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Employee entity.
    *
    * @param Employee $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Employee $entity)
    {
        $form = $this->createForm(new EmployeeType(), $entity, array(
            'action' => $this->generateUrl('admin_employee_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Employee entity.
     *
     * @Route("/{id}", name="admin_employee_update")
     * @Method("PUT")
     * @Template("LysenkoVAServiceCenterBundle:Employee:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LysenkoVAServiceCenterBundle:Employee')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Employee entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->remove('roles');
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('cabinet'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Employee entity.
     *
     * @Route("/{id}", name="admin_employee_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('LysenkoVAServiceCenterBundle:Employee')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Employee entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cabinet'));
    }

    /**
     * Creates a form to delete a Employee entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_employee_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
