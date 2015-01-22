<?php

namespace VladyslavLysenko\SimpleTestFormBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use VladyslavLysenko\SimpleTestFormBundle\Entity\Question;
use VladyslavLysenko\SimpleTestFormBundle\Entity\Variant;
use VladyslavLysenko\SimpleTestFormBundle\Form\QuestionType;

/**
 * Question controller.
 *
 */
class QuestionController extends Controller
{


    /**
     * Lists all Question entities.
     *
     */
    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $test = $em->getRepository('VladyslavLysenkoSimpleTestFormBundle:Test')->find($id);
        $entities = $test->getQuestions();
        return $this->render('VladyslavLysenkoSimpleTestFormBundle:Question:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Question entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Question();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            for($i=0;$i<$entity->getQuantityOfAnswers();$i++) {
                $variant = new Variant($entity);
                $variant->setDescription("vatiant to be changed...");
                $variant->setQuantityOfPoints(1);
                $entity->getVariants()->add($variant);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_index'));
        }

        return $this->render('VladyslavLysenkoSimpleTestFormBundle:Question:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Question entity.
    *
    * @param Question $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Question $entity)
    {
        $form = $this->createForm(new QuestionType(), $entity, array(
            'action' => $this->generateUrl('question_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Question entity.
     *
     */
    public function newAction()
    {

        $entity = new Question();
//        $entity = new Variant($question);
        $form   = $this->createCreateForm($entity);

        return $this->render('VladyslavLysenkoSimpleTestFormBundle:Question:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Question entity.
     *
     */
//    public function showAction($id)
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('VladyslavLysenkoSimpleTestFormBundle:Question')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find Question entity.');
//        }
//
//        $deleteForm = $this->createDeleteForm($id);
//
//        return $this->render('VladyslavLysenkoSimpleTestFormBundle:Question:show.html.twig', array(
//            'entity'      => $entity,
//            'delete_form' => $deleteForm->createView(),        ));
//    }

    /**
     * Displays a form to edit an existing Question entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VladyslavLysenkoSimpleTestFormBundle:Question')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Question entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('VladyslavLysenkoSimpleTestFormBundle:Question:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'id'=>$id,
        ));
    }

    /**
    * Creates a form to edit a Question entity.
    *
    * @param Question $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Question $entity)
    {
        $form = $this->createForm(new QuestionType(), $entity, array(
            'action' => $this->generateUrl('question_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Question entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VladyslavLysenkoSimpleTestFormBundle:Question')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Question entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('question_edit', array('id' => $id)));
        }

        return $this->render('VladyslavLysenkoSimpleTestFormBundle:Question:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Question entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('VladyslavLysenkoSimpleTestFormBundle:Question')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Question entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_index'));
    }

    /**
     * Creates a form to delete a Question entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('question_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
