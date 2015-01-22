<?php
/**
 * Created by PhpStorm.
 * User: vladyslav
 * Date: 12.06.14
 * Time: 15:50
 */

namespace VladyslavLysenko\SimpleTestFormBundle\Controller;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use VladyslavLysenko\SimpleTestFormBundle\Entity\Test;
use VladyslavLysenko\SimpleTestFormBundle\Form\TestType;
use VladyslavLysenko\SimpleTestFormBundle\Form\TestShowType;
class AdminController extends Controller{
    public function adminMainPageAction(){
        //getting logged user id
        $user = $this->get('security.context')->getToken()->getUser();
        $userId = $user->getId();

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('VladyslavLysenkoSimpleTestFormBundle:Test')->findBy(array('idUser'=>$userId));

        return $this->render('VladyslavLysenkoSimpleTestFormBundle:Admin:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    public function resultsAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VladyslavLysenkoSimpleTestFormBundle:Result')->findBy(array('testId'=>$id));

//
//        $form = $this->createForm(new TestShowType(), $entity);
//        $form->handleRequest($request);
//        if ($form->isValid()) {
//
//        }
        return $this->render('VladyslavLysenkoSimpleTestFormBundle:Admin:results.html.twig', array(
          'entities'=>$entity
        ));
    }

} 