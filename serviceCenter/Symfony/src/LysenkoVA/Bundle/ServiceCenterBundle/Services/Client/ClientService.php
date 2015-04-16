<?php
/**
 * Created by PhpStorm.
 * User: vladyslav
 * Date: 11.03.15
 * Time: 16:48
 */

namespace LysenkoVA\Bundle\ServiceCenterBundle\Services\Client;

use LysenkoVA\Bundle\ServiceCenterBundle\Entity\Client;
use LysenkoVA\Bundle\ServiceCenterBundle\Form\ClientType;
use LysenkoVA\Bundle\ServiceCenterBundle\Services\FormService;
use Symfony\Component\Form\FormFactoryInterface;

class ClientService  extends FormService{

    public function __construct(FormFactoryInterface $formFactory, $router)
    {
        parent::__construct($formFactory,$router);
    }

    /**
     * Creates a form to create a Client entity.
     *
     * @param Client $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    public function createCreateForm(Client $entity)
    {
        $form = $this->formFactory->create(new ClientType(), $entity, array(
            'action' => $this->router->generate('admin_client_create'),
            'method' => 'POST',
        ));

      //  $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Creates a form to edit a Client entity.
     *
     * @param Client $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    public function createEditForm(Client $entity)
    {
        $form = $this->formFactory->create(new ClientType(), $entity, array(
            'action' => $this->router->generate('admin_client_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Creates a form to delete a Client entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    public function createDeleteForm($id)
    {
        return $this->formFactory->createBuilder()
            ->setAction($this->router->generate('admin_client_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
            ;
    }

}