<?php

namespace VladyslavLysenko\SimpleTestFormBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use VladyslavLysenko\SimpleTestFormBundle\Entity\Question;
use VladyslavLysenko\SimpleTestFormBundle\Entity\Variant;
use VladyslavLysenko\SimpleTestFormBundle\Form\VariantType;

/**
 * Variant controller.
 *
 */
class VariantController extends Controller
{

    /**
     * Lists all Variant entities.
     *
     */
    public function indexAction($quastion_id)
    {
        $em = $this->getDoctrine()->getManager();

        $question = $em->getRepository('VladyslavLysenkoSimpleTestFormBundle:Question')->find(
            $quastion_id);
        $entities = $question->getVariants();
        return $this->render('VladyslavLysenkoSimpleTestFormBundle:Variant:index.html.twig', array(
            'entities' => $entities,'id'=>$quastion_id,
        ));
    }
    /**
     * Creates a new Variant entity.
     *
     */
    public function createAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $question = $em->getRepository('VladyslavLysenkoSimpleTestFormBundle:Question')->find($id);
        $entity = new Variant($question);
        $form   = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('variant_show', array('id' => $entity->getId())));
        }

        return $this->render('VladyslavLysenkoSimpleTestFormBundle:Variant:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Variant entity.
    *
    * @param Variant $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Variant $entity)
    {
        $form = $this->createForm(new VariantType(), $entity);

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Variant entity.
     *
     */
//    public function newAction($id)
//    {
//        $em = $this->getDoctrine()->getManager();
//        $question = $em->getRepository('VladyslavLysenkoSimpleTestFormBundle:Question')->find($id);
//        $entity = new Variant($question);
//        $form   = $this->createCreateForm($entity);
//
//        return $this->render('VladyslavLysenkoSimpleTestFormBundle:Variant:new.html.twig', array(
//            'entity' => $entity,
//            'form'   => $form->createView(),
//        ));
////        return $this->redirect($this->generateUrl('index'));
//    }

    /**
     * Finds and displays a Variant entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VladyslavLysenkoSimpleTestFormBundle:Variant')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Variant entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('VladyslavLysenkoSimpleTestFormBundle:Variant:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),'q_id'=>$id        ));
    }

    /**
     * Displays a form to edit an existing Variant entity.
     *
     */
    public function editAction($question_id,$id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VladyslavLysenkoSimpleTestFormBundle:Variant')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Variant entity.');
        }

        $editForm = $this->createEditForm($entity,$question_id);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('VladyslavLysenkoSimpleTestFormBundle:Variant:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Variant entity.
    *
    * @param Variant $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Variant $entity, $question_id)
    {
        $form = $this->createForm(new VariantType(), $entity, array(
            'action' => $this->generateUrl('variant_update', array('id' => $entity->getId(),
                'question_id'=>$question_id)),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Variant entity.
     *
     */
    public function updateAction(Request $request,$question_id, $id)
    {
//        var_dump($question_id);
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VladyslavLysenkoSimpleTestFormBundle:Variant')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Variant entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity,$question_id);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('variant', array('quastion_id' => $question_id)));
        }

        return $this->render('VladyslavLysenkoSimpleTestFormBundle:Variant:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Variant entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('VladyslavLysenkoSimpleTestFormBundle:Variant')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Variant entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_index'));
    }

    /**
     * Creates a form to delete a Variant entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('variant_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
