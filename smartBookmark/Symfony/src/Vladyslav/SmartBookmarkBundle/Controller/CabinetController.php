<?php

namespace Vladyslav\SmartBookmarkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

use Vladyslav\SmartBookmarkBundle\Form\Type\BookmarkType;
use Vladyslav\SmartBookmarkBundle\Entity\Bookmark;
use Vladyslav\SmartBookmarkBundle\Entity\Category;
class CabinetController extends Controller{

    public function sendMailAction(Request $request){
        $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            //->setFrom('valysenko95@gmail.com')
            ->setFrom('valysenko95@gmail.com')
            ->setTo('stalkervlad2011@ukr.net')
            //->setBody('Hello. This is an email from symfony application!');
            ->setBody(
                $this->renderView(
                    'VladyslavSmartBookmarkBundle:Cabinet:cabinet.html.twig'
                )
            );
        $this->get('mailer')->send($message);


        return $this->render('VladyslavSmartBookmarkBundle:Cabinet:cabinet.html.twig');
    }
    public function cabinetAction(Request $request){
//        $category_repository = $this->getDoctrine()
//            ->getRepository('VladyslavSmartBookmarkBundle:Category');
//        $bookmark_repository = $this->getDoctrine()
//            ->getRepository('VladyslavSmartBookmarkBundle:Bookmark');
//        $em = $this->getDoctrine()->getManager();
        return $this->render('VladyslavSmartBookmarkBundle:Cabinet:cabinet.html.twig');
    }



    public function addBookmarkAction(Request $request){
        $category_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:Category');
        $bookmark_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:Bookmark');
        $em = $this->getDoctrine()->getManager();

//        $p = $bookmark_repository->findAll();
//        var_dump($p);
        $bookmark = new Bookmark();
        $form = $this->createForm(new BookmarkType(),$bookmark);
        $form->handleRequest($request);
        if($form->isValid()){
            if($form->get('add')->isClicked()){
                $name = $form["name"]->getData();
                $url = $form["link"]->getData();
                $category_name = $form["category"]->getData();
                $category = $category_repository
                    ->findOneBy(array('name'=>$category_name));
                /*
                 * adding category if is not exists
                 * */
                if (!$category) {
                    $c = new Category();
                    $c->setName($category_name);
                    $em->persist($c);
                    $em->flush();

                    $categ = $category_repository
                        ->findOneBy(array('name'=>$category_name));
                    $id_category = $categ->getId();

                    $bookmark = new Bookmark();
                    $bookmark->setName($name);
                    $bookmark->setIdUser(0);
                    $bookmark->setIdCategory($id_category);
                    $bookmark->setLink($url);
                    $bookmark->setDateTime(new \DateTime());
                    $em->persist($bookmark);
                    $em->flush();
                }
                else{
                    echo "<script>alert('hello!');</script>";
                    $id_category = $category->getId();
                    $bookmark = new Bookmark();
                    $bookmark->setName($name);
                    $bookmark->setIdUser(0);
                    $bookmark->setIdCategory($id_category);
                    $bookmark->setLink($url);
                    $bookmark->setDateTime(new \DateTime());
                    $em->persist($bookmark);
                    $em->flush();
                }
            }
        }
        return $this->render('VladyslavSmartBookmarkBundle:Cabinet:addBookmark.html.twig',array('form'=>$form->createView()));
    }
}
