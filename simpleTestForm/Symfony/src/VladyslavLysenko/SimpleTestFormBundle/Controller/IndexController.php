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

use VladyslavLysenko\SimpleTestFormBundle\Entity\Result;
use VladyslavLysenko\SimpleTestFormBundle\Entity\Test;
use VladyslavLysenko\SimpleTestFormBundle\Form\TestType;
use VladyslavLysenko\SimpleTestFormBundle\Form\TestShowType;
class IndexController extends Controller{
    public function mainPageAction(){
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('VladyslavLysenkoSimpleTestFormBundle:Test')->findBy(array('isActive'=>1));

        return $this->render('VladyslavLysenkoSimpleTestFormBundle:Index:index.html.twig', array(
            'entities' => $entities,
        ));
    }



    public function showFullTestAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $result_repository = $em->getRepository('VladyslavLysenkoSimpleTestFormBundle:Result');
        $test_entity = $em->getRepository('VladyslavLysenkoSimpleTestFormBundle:Test')->find($id);
        if(!$test_entity)
            throw new FileNotFoundException;


        $form = $this->createForm(new TestShowType(), $test_entity);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $f = $this->get('vladyslav_lysenko_simple_test_form.example');
            //$f->parse();
            $data = $this->get('request')->request->all();
            $result = $f->parse($em,$data,$id,$form,$test_entity->getMaxMark());
            $em->persist($result);
            $em->flush();

            /**
             * showing result
             */
            return $this->render('VladyslavLysenkoSimpleTestFormBundle:Index:showFullTest.html.twig', array(
                'form' => $form->createView(),'testName'=>$test_entity->getDescription(),
                'result'=>$result->getMark(),'percents'=>$result->getPercents()
            ));
        }
        return $this->render('VladyslavLysenkoSimpleTestFormBundle:Index:showFullTest.html.twig', array(
            'form' => $form->createView(),'testName'=>$test_entity->getDescription(),
            'result'=>null,'percents'=>null
        ));
    }

} 