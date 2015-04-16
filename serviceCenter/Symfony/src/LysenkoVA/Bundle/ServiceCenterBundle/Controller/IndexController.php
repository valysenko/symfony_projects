<?php
/**
 * Created by PhpStorm.
 * User: vladyslav
 * Date: 09.03.15
 * Time: 12:31
 */

namespace LysenkoVA\Bundle\ServiceCenterBundle\Controller;
use LysenkoVA\Bundle\ServiceCenterBundle\Entity\Complaint;
use LysenkoVA\Bundle\ServiceCenterBundle\Entity\Employee;
use LysenkoVA\Bundle\ServiceCenterBundle\Entity\Role;
use LysenkoVA\Bundle\ServiceCenterBundle\Form\ComplaintType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;


class IndexController extends Controller{
    /**
     * @Route("/", name="index")
     * @Template()
     */
    public function indexAction(){

        $em = $this->getDoctrine()->getManager();

        $departments = $em->getRepository('LysenkoVAServiceCenterBundle:Department')
            ->findAll();

        $categories = $em->getRepository('LysenkoVAServiceCenterBundle:Category')
            ->findAll();

        return array(
            'departments' => $departments,
            'categories' => $categories
        );
    }

    /**
     * @Route("/comlaints/{id}", name="show_complaints_index")
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
     * @Route("/complaint/create/{id}", name="create_complaint")
     * @Template()
     */
    public function createComplaintAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        $department = $em->getRepository('LysenkoVAServiceCenterBundle:Department')
            ->findOneById($id);

        $complaint = new Complaint();
        $complaint->setDate(new \DateTime());
        $complaint->setDepartment($department);
        $form = $this->createForm(new ComplaintType(), $complaint);
        $form->handleRequest($request);
        if($form->isValid()){
            $em->persist($complaint);

            $em->flush();
            return $this->redirect($this->generateUrl('index'));
        }

        return array(
            'form'=>$form->createView(),
            'department'=>$department
        );
    }

    /**
     * @Route("/find", name="find_contract")
     * @Template()
     */
    public function findContractAction(){
        $request = Request::createFromGlobals();
        $em = $this->getDoctrine()->getManager();
        if(($request->get('number')!=null)){
            $contract = $em->getRepository('LysenkoVAServiceCenterBundle:Contract')
                ->findByNumber($request->get('number'));
            if($contract==null)
                return array(
                    'error'=>"There is no contract with such number, try again!",
                    'contract'=>null
                );
            return array(
                'contract'=>$contract,
                'error'=>null
            );
        }

        return array(
            'contract'=>null,
            'error'=>null
            );
    }
}