<?php

namespace LysenkoVA\Bundle\ServiceCenterBundle\Controller;

use LysenkoVA\Bundle\ServiceCenterBundle\Entity\Client;
use LysenkoVA\Bundle\ServiceCenterBundle\Entity\Device;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use LysenkoVA\Bundle\ServiceCenterBundle\Entity\Contract;
use LysenkoVA\Bundle\ServiceCenterBundle\Form\ContractType;

/**
 * Contract controller.
 *
 * @Route("/admin/contract")
 */
class ContractController extends Controller
{

    /**
     * Lists all Contract entities.
     *
     * @Route("/{id}", name="admin_contract",requirements={
     *     "id": "\d+"})
     * @Method("GET")
     * @Template()
     */
    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        //getting logged user id
        $user = $this->get('security.context')->getToken()->getUser();

        $entities = $em->getRepository('LysenkoVAServiceCenterBundle:Contract')->findBy(
            array('manager'=>$user)
        );

        return array(
            'entities' => $entities,
            'id'=>$user->getId()
        );
    }
    /**
     * Creates a new Contract entity.
     *
     * @Route("/", name="admin_contract_create")
     * @Method("POST")
     * @Template("LysenkoVAServiceCenterBundle:Contract:new.html.twig")
     */
    public function createAction(Request $request)
    {
        //getting logged user id
        $user = $this->get('security.context')->getToken()->getUser();

        $contractService = $this->get('contract_service');
        $contract = new Contract();
        $contract->setManager($user);
        $contract->setDate(new \DateTime());
        $contract->setStatus('in progress');
        $contract->setSum(0);

        $device = new Device();
        $client = new Client();

        $em = $this->getDoctrine()->getManager();

        $clientRepository = $em->getRepository('LysenkoVAServiceCenterBundle:Client');

        $masters = $em->getRepository('LysenkoVAServiceCenterBundle:Employee')
            ->findMastersFromDepartment($user->getDepartment());

        $contractForm   = $contractService->createCreateForm($contract,$masters);

        $contractForm->handleRequest($request);

        if ($contractForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            // checking if client exists in db
            $client =  $contractForm->getData()->getDevice()->getClient();



            $cl = $clientRepository->findOneBy(array(
                'firstName'=>$client->getFirstName(),
                'surname'=>$client->getSurname(),
                'telephoneNumber'=>$client->getTelephoneNumber(),
                'email'=>$client->getEmail(),
            ));
            $contract->getDevice()->setPropertyOfSc(false);
            if($cl){
//                $contract =  $contractForm->getData();
//                $device =  $contractForm->getData()->getDevice();
//
//                $cl->addDevice($device);
//                $device->setClient($cl);
//                $contract->setDevice($device);


                $contract->getDevice()->setClient($cl);
              //  $device =  $contractForm->getData()->getDevice();
//                $em->persist($cl);
//                $em->persist($device);
                $em->persist($contract);
                $em->flush();

            }
            else{
                  $em->persist($contract);

                  $em->flush();
            }

          return $this->redirect($this->generateUrl('cabinet'));
        }

        return array(
            'id'=>$user->getId(),
            'contract_form'   => $contractForm->createView(),
        );
    }



    /**
     * Displays a form to create a new Contract entity.
     *
     * @Route("/new", name="admin_contract_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        //getting logged user id
        $user = $this->get('security.context')->getToken()->getUser();

        $contractService = $this->get('contract_service');


        $contract = new Contract();

        $em = $this->getDoctrine()->getManager();


        $masters = $em->getRepository('LysenkoVAServiceCenterBundle:Employee')
            ->findMastersFromDepartment($user->getDepartment());
//        $masters = $em->getRepository('LysenkoVAServiceCenterBundle:Employee')
//            ->findAll();
        $contractForm   = $contractService->createCreateForm($contract,$masters);

        return array(
            'entity' => $contract,
            'contract_form'   => $contractForm->createView(),
            'id' =>$user->getId()
        );
    }

    /**
     * Finds and displays a Contract entity.
     *
     * @Route("/{id}", name="admin_contract_show",requirements={
     *     "id": "\d+"})
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $contractService = $this->get('contract_service');
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LysenkoVAServiceCenterBundle:Contract')->find($id);

         //getting logged user id
        $user = $this->get('security.context')->getToken()->getUser();

         $masters = $em->getRepository('LysenkoVAServiceCenterBundle:Employee')
            ->findMastersFromDepartment($user->getDepartment());
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contract entity.');
        }

        $deleteForm = $contractService->createDeleteForm($id,$masters);

        return array(
            'entity'      => $entity,
            'id'=>$user->getId(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Contract entity.
     *
     * @Route("/{id}/edit", name="admin_contract_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        //getting logged user id
        $user = $this->get('security.context')->getToken()->getUser();

        $masters = $em->getRepository('LysenkoVAServiceCenterBundle:Employee')
            ->findMastersFromDepartment($user->getDepartment());

        $contractService = $this->get('contract_service');


        $entity = $em->getRepository('LysenkoVAServiceCenterBundle:Contract')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contract entity.');
        }

        $editForm = $contractService->createEditForm($entity,$masters);
        $editForm->remove('number');
        $deleteForm = $contractService->createDeleteForm($id,$masters);

        return array(
            'entity'      => $entity,
            'id'=>$user->getId(),
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }


    /**
     * Edits an existing Contract entity.
     *
     * @Route("/{id}", name="admin_contract_update")
     * @Method("POST")
     * @Template("LysenkoVAServiceCenterBundle:Contract:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $contractService = $this->get('contract_service');
//
        $em = $this->getDoctrine()->getManager();
       // $em->getConnection()->beginTransaction();

        //getting logged user id
        $user = $this->get('security.context')->getToken()->getUser();

        $masters = $em->getRepository('LysenkoVAServiceCenterBundle:Employee')
            ->findMastersFromDepartment($user->getDepartment());

        $entity = $em->getRepository('LysenkoVAServiceCenterBundle:Contract')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contract entity.');
        }

        $deleteForm = $contractService->createDeleteForm($id,$masters);
        $editForm = $contractService->createEditForm($entity,$masters);
        $editForm->remove('number');
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            $em->flush();
           // return $this->redirect($this->generateUrl('admin_contract_edit', array('id' => $id)));
            return $this->redirect($this->generateUrl('cabinet'));
        }

        return array(
            'entity'      => $entity,
            'id'=>$user->getId(),
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Contract entity.
     *
     * @Route("/{id}", name="admin_contract_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $contractService = $this->get('contract_service');

        $form = $contractService->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('LysenkoVAServiceCenterBundle:Contract')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Contract entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cabinet'));
    }


}
