<?php
/**
 * Created by PhpStorm.
 * User: vladyslav
 * Date: 09.03.15
 * Time: 13:30
 */

namespace LysenkoVA\Bundle\ServiceCenterBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use LysenkoVA\Bundle\ServiceCenterBundle\Entity\MadeService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Validator\Constraints\DateTime;

class AdminController extends Controller{

   /**
     * @Route("/admin", name="cabinet")
    * @Template("LysenkoVAServiceCenterBundle:Admin:contracts.html.twig")
     */
    public function adminAction()
    {
        if($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            return $this->redirectToRoute('admin_departments');
        }
        //getting logged user id
        $user = $this->get('security.context')->getToken()->getUser();
        $role = $this->get('security.authorization_checker')->isGranted('ROLE_MANAGER');

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('LysenkoVAServiceCenterBundle:Contract')
            ->findAllContractByEmployee($user);

        return array(
            'items' => $repo,
            'manager' =>$role,
            'current' =>false,
            'id' =>$user->getId()
        );
    }

    /**
     * @Route("/admin/contracts/unmanaged/{id}", name="unmanaged_contracts")
     * @Template()
     */
    public function unmanagedContractsAction($id){
        $em = $this->getDoctrine()->getManager();
        $department = $em->getRepository('LysenkoVAServiceCenterBundle:Department')->find($id);
        $contracts = $em->getRepository('LysenkoVAServiceCenterBundle:Contract')
           ->findUnmanagedContractByDepartment( $department);
        //$contracts = $em->getRepository('LysenkoVAServiceCenterBundle:Contract')->findAll();
       // $contract = $em->getRepository('LysenkoVAServiceCenterBundle:Contract')->find(7);
       // var_dump($contract->getManager());
        return array(
            'contracts' => $contracts,
        );
    }

    /**
     * @Route("/admin/contracts/add/{id}", name="add_manager_to_unnamed")
     * @Template()
     */
    public function addManagerAction(Request $request,  $id){
        $em = $this->getDoctrine()->getManager();

        $contract = $em->getRepository('LysenkoVAServiceCenterBundle:Contract')
            ->findOneById( $id);

        $managers = $em->getRepository('LysenkoVAServiceCenterBundle:Employee')
            ->findManagersFromDepartment($contract->getMaster()->getDepartment());

        $form = $this->createFormBuilder($contract)
            ->add('manager','entity', array(
                'class' => 'LysenkoVA\Bundle\ServiceCenterBundle\Entity\Employee',
                'choices' => $managers))
            ->add('add', 'submit', array('label' => 'Add'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em->flush();
            // return $this->redirect($this->generateUrl('admin_contract_edit', array('id' => $id)));
           return $this->redirect($this->generateUrl('cabinet'));
        }

        return array(
            'form' => $form->createView(),
        );
    }



    /**
     * @Route("/admin/departments", name="admin_departments")
     * @Template("LysenkoVAServiceCenterBundle:Admin:admin_departments.html.twig")
     */
    public function adminPageAction()
    {
        $em = $this->getDoctrine()->getManager();
        $departments = $em->getRepository('LysenkoVAServiceCenterBundle:Department')
            ->findAll();

        return array(
            'departments' => $departments,
        );
    }

    /**
     * @Route("/admin/comlaints/{id}", name="show_complaints")
     * @Template("LysenkoVAServiceCenterBundle:Admin:show_complaints.html.twig")
     */
    public function showComplaintsAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $department = $em->getRepository('LysenkoVAServiceCenterBundle:Department')
            ->findOneById($id);

        return array(
            'department' => $department,
        );
    }

    /**
     * @Route("/admin/managers/best/{id}", name="best_managers")
     * @Template("LysenkoVAServiceCenterBundle:Admin:bestManagers.html.twig")
     */
    public function bestManagersAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $department = $em->getRepository('LysenkoVAServiceCenterBundle:Department')
            ->findOneById($id);

        $result = $em->getRepository('LysenkoVAServiceCenterBundle:Contract')
            ->getSumOfEmployeesOfDepartment($department);
        return array(
            'result' => $result,
        );
    }

    /**
     * @Route("/admin/add/employee{id}", name="add_employee")
     * @Template("LysenkoVAServiceCenterBundle:Admin:add_employee.html.twig")
     */
    public function addEmployeeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $department = $em->getRepository('LysenkoVAServiceCenterBundle:Department')
            ->findOneById($id);

        return array(
            'department' => $department,
        );
    }

    /**
     * @Route("/admin/money", name="admin_money")
     * @Template("LysenkoVAServiceCenterBundle:Admin:money.html.twig")
     */
    public function allMoneyAction()
    {
        //getting logged user id
        $user = $this->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository('LysenkoVAServiceCenterBundle:Contract')
            ->getSumOfAllContracts($user);

        return array(
            'sum' =>$result->sum,
            'id' =>$user->getId()
        );

    }

    /**
     * @Route("/admin/contracts/current", name="contracts_current")
     * @Template("LysenkoVAServiceCenterBundle:Admin:contracts.html.twig")
     */
    public function allCurrentManagerContractsAction(){

        //getting logged user id
        $user = $this->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('LysenkoVAServiceCenterBundle:Contract')
            ->findCurrentContractByEmployee($user);

        return array(
            'items' => $repo,
            'manager'=>true,
            'current' =>true,
            'id' =>$user->getId()
        );
    }

    /**
     * @Route("/admin/master/contracts/current", name="master_contracts_current")
     * @Template("LysenkoVAServiceCenterBundle:Admin:contracts.html.twig")
     */
    public function allCurrentMasterContractsAction(){

        //getting logged user id
        $user = $this->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('LysenkoVAServiceCenterBundle:Contract')
            ->findCurrentContractByEmployee($user);
        return array(
            'items' => $repo,
            'current' =>true,
            'manager' =>false,
            'id' =>$user->getId()
        );
    }

    /**
     * @Route("/admin/master/action/manage/{id}", name="show_add_service")
     * @Template("LysenkoVAServiceCenterBundle:Admin:add_service.html.twig")
     */
    public function showAddServiceAction($id){
        $error = "";
        $request = Request::createFromGlobals();
        $em = $this->getDoctrine()->getManager();
        if(($request->get('price')!=null)){
            $service = $em->getRepository('LysenkoVAServiceCenterBundle:MadeService')
                ->findOneById($request->get('id'));
            if($request->get('price')<0){
                $error = 'Price must be greater then 0!';

            }
            else {
                $service->setPrice($request->get('price'));
                $service->setComment($request->get('comment'));
                $em->persist($service);
                $em->flush();
            }
        }


        //getting logged user id
        $user = $this->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();
        $contract = $em->getRepository('LysenkoVAServiceCenterBundle:Contract')
            ->findOneById($id);
        $categories =  $em->getRepository('LysenkoVAServiceCenterBundle:Category')->findAll();


        return array(
            'contract'=>$contract,
            'categories'=>$categories,
            'error' => $error
        );
    }

    /**
     * @Route("/admin/master/action/add/{contractId}/{serviceId}", name="add_service")
     */
    public function addServiceAction($contractId,$serviceId){
        $em = $this->getDoctrine()->getManager();
        $contract = $em->getRepository('LysenkoVAServiceCenterBundle:Contract')
            ->findOneById($contractId);

        $service = $em->getRepository('LysenkoVAServiceCenterBundle:Service')
            ->findOneById($serviceId);

        $madeService = new MadeService();
        $madeService->setPrice($service->getPrice());
        $madeService->setName($service->getName());
        $madeService->setContract($contract);
        $madeService->setComment("");

        $em->persist($madeService);
        $contract->addMadeService($madeService);
        $em->persist($contract);
        $em->flush();
        return $this->redirectToRoute('show_add_service', array('id'=>$contractId));
    }

    /**
     * @Route("/admin/master/action/delete/{contractId}/{serviceId}", name="delete_service")
     */
    public function deleteMadeServiceAction($contractId,$serviceId){
        $em = $this->getDoctrine()->getManager();
        $contract = $em->getRepository('LysenkoVAServiceCenterBundle:Contract')
            ->findOneById($contractId);

        $service = $em->getRepository('LysenkoVAServiceCenterBundle:MadeService')
            ->findOneById($serviceId);

        $em->remove($service);
        $contract->removeMadeService($service);
        $em->persist($contract);
        $em->flush();
        return $this->redirectToRoute('show_add_service', array('id'=>$contractId));
    }

    /**
     * @Route("/admin/manager/finish/{contractId}", name="finish_contract")
     */
    public function finishContractAction($contractId){
        $em = $this->getDoctrine()->getManager();
        $contract = $em->getRepository('LysenkoVAServiceCenterBundle:Contract')
            ->findOneById($contractId);

        $contract->setDateOfEnd(new \DateTime());

        $contract->setStatus('finished');
        $em->persist($contract);
         $em->flush();
        return $this->redirectToRoute('cabinet');
    }

    /**
     * @Route("/admin/manager/finishWork/{contractId}", name="finishWork_contract")
     */
    public function finishAllWorkContractAction($contractId){
        $em = $this->getDoctrine()->getManager();
        $contract = $em->getRepository('LysenkoVAServiceCenterBundle:Contract')
            ->findOneById($contractId);

        $sum = 0;
        foreach($contract->getMadeServices() as $service){
            $sum+=$service->getPrice();
        }
        $contract->setSum($sum);
        $contract->setStatus('finished work');
        $em->persist($contract);
        $em->flush();
        return $this->redirectToRoute('cabinet');
    }

    /**
     * @Route("/admin/manager/finishWorddk/{contractId}", name="finishWork_contract3")
     * @Template("LysenkoVAServiceCenterBundle:Admin:mastersByService.html.twig")
     */
    public function mastersByServiceAction(){

        //getting logged user id
        $user = $this->get('security.context')->getToken()->getUser();

        return array();
    }


}