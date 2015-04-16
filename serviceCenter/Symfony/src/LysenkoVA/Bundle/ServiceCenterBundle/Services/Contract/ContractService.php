<?php
/**
 * Created by PhpStorm.
 * User: vladyslav
 * Date: 11.03.15
 * Time: 15:51
 */
namespace LysenkoVA\Bundle\ServiceCenterBundle\Services\Contract;

use LysenkoVA\Bundle\ServiceCenterBundle\Entity\Contract;
use LysenkoVA\Bundle\ServiceCenterBundle\Form\ContractType;
use LysenkoVA\Bundle\ServiceCenterBundle\Services\FormService;
use Symfony\Component\Form\FormFactoryInterface;

class ContractService extends FormService{

    public function __construct(FormFactoryInterface $formFactory, $router)
    {
        parent::__construct($formFactory,$router);
    }

    /**
     * Creates a form to create a Contract entity.
     *
     * @param Contract $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    public function createCreateForm(Contract $entity,$choices)
    {
        $form = $this->formFactory->create(new ContractType($choices), $entity, array(
            'action' => $this->router->generate('admin_contract_create'),
            'method' => 'POST',
//            'data'=>$choices,
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Creates a form to edit a Contract entity.
     *
     * @param Contract $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    public function createEditForm(Contract $entity,$choices)
    {
        $form = $this->formFactory->create(new ContractType($choices), $entity, array(
            'action' => $this->router->generate('admin_contract_update', array('id' => $entity->getId())),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Creates a form to delete a Contract entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    public function createDeleteForm($id)
    {
        return $form = $this->formFactory->createBuilder()
            ->setAction($this->router->generate('admin_contract_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
            ;
    }



}