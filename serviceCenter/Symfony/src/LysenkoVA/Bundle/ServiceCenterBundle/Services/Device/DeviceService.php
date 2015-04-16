<?php
/**
 * Created by PhpStorm.
 * User: vladyslav
 * Date: 11.03.15
 * Time: 16:48
 */

namespace LysenkoVA\Bundle\ServiceCenterBundle\Services\Device;

use LysenkoVA\Bundle\ServiceCenterBundle\Entity\Device;
use LysenkoVA\Bundle\ServiceCenterBundle\Form\DeviceType;
use LysenkoVA\Bundle\ServiceCenterBundle\Services\FormService;
use Symfony\Component\Form\FormFactoryInterface;

class DeviceService  extends FormService{

    public function __construct(FormFactoryInterface $formFactory, $router)
    {
        parent::__construct($formFactory,$router);
    }
    /**
     * Creates a form to create a Device entity.
     *
     * @param Device $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    public function createCreateForm(Device $entity)
    {
        $form = $this->formFactory->create(new DeviceType(), $entity, array(
            'action' => $this->router->generate('admin_device_create'),
            'method' => 'POST',
        ));

       // $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Creates a form to edit a Device entity.
     *
     * @param Device $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    public function createEditForm(Device $entity)
    {
        $form = $this->formFactory->create(new DeviceType(), $entity, array(
            'action' => $this->router->generate('admin_device_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Creates a form to delete a Device entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    public function createDeleteForm($id)
    {
        return $this->formFactory->createBuilder()
            ->setAction($this->router->generate('admin_device_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
            ;
    }


}