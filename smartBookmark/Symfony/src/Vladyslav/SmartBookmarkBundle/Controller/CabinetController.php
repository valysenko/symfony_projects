<?php

namespace Vladyslav\SmartBookmarkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\Security\Core\Util\SecureRandom;
use Vladyslav\SmartBookmarkBundle\Form\Type\BookmarkType;
use Vladyslav\SmartBookmarkBundle\Entity\TempBookmark;
use Vladyslav\SmartBookmarkBundle\Entity\Bookmark;
use Vladyslav\SmartBookmarkBundle\Entity\Category;
use Vladyslav\SmartBookmarkBundle\Entity\User;
use Vladyslav\SmartBookmarkBundle\Entity\Role;
class CabinetController extends Controller{

   /*
    * temp bookmarks of the user
    * */
    public function responsedBookmarksAction(Request $request){
        $tempBookmark_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:TempBookmark');
         //getting logged user id
        $user = $this->get('security.context')->getToken()->getUser();
        $userId = $user->getId();

        $bookmarks = $tempBookmark_repository->findBy(array('idUser'=>$userId));
        return $this->render('VladyslavSmartBookmarkBundle:Cabinet:responsedBookmarks.html.twig',array('bookmarks'=>$bookmarks));
    }

    public function cabinetAction(Request $request){
        $category_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:Category');
        $bookmark_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:Bookmark');
        $user_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:User');
        $em = $this->getDoctrine()->getManager();

        //getting logged user id
        $user = $this->get('security.context')->getToken()->getUser();
        $userId = $user->getId();

        $bookmarks = $bookmark_repository->findBy(array('idUser'=>$userId));
//        $user = $user_repository->findOneBy(array('id'=>11));
//        $em->remove($user);
//        $em->flush();

//        $user = $bookmark_repository->findOneBy(array('id'=>1));
//        $em->remove($user);
//        $em->flush();
//         $user = $bookmark_repository->findOneBy(array('id'=>2));
//        $em->remove($user);
//        $em->flush();


        return $this->render('VladyslavSmartBookmarkBundle:Cabinet:cabinet.html.twig',array('bookmarks'=>$bookmarks));
    }

    public function sendListAction(Request $request){
        $category_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:Category');
        $bookmark_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:Bookmark');
        $em = $this->getDoctrine()->getManager();

        //getting logged user id
        $user = $this->get('security.context')->getToken()->getUser();
        $userId = $user->getId();

        $bookmarks = $bookmark_repository->findBy(array('idUser'=>$userId));


        return $this->render('VladyslavSmartBookmarkBundle:Cabinet:sendList.html.twig',array('bookmarks'=>$bookmarks));
    }


    /*
     * Sending a bookmark
     * */

    public function sendBookmarkAction(Request $request, $id){
        $tempBookmark_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:TempBookmark');
        $category_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:Category');
        $bookmark_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:Bookmark');
        $user_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:User');
        $roles_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:Role');
        $em = $this->getDoctrine()->getManager();
        $bookmarks = $bookmark_repository->findAll();
        $user = new User();
        $form = $this->createFormBuilder($user)
            ->add('email','email')
            ->add('send', 'submit')
            ->getForm();
        $form->handleRequest($request);
        /*
         * if there is no user with email such as an email from the form:
            1.user will be added to the database:
                1. calculating username
                2. generating password
                3. adding user to the database
            2. adding a bookmark to the table of temp bookmarks
        */
        if($form->isValid()){

            $email =$form['email']->getData();
            $user = $user_repository->findOneBy(array('email'=>$email));

            $username="";
            $password="";
            $gen_password="";
            if($user==null){
                //1
                $findme   = '@';
                $pos = strpos($email, $findme);
                $username = substr($email,0,$pos);

                //2
                $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
                  $numChars = strlen($chars);
                   $gen_password= '';
                  for ($i = 0; $i < 10; $i++) {
                    $gen_password .= substr($chars, rand(1, $numChars) - 1, 1);
                  }

                //3
                $role = $roles_repository->findOneBy(array('id'=>1));
                $user = new User();
                $user->setUsername($username);
                $user->setEmail($email);
                $user->setSalt(md5(time()));
                $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
                $password = $encoder->encodePassword($gen_password, $user->getSalt());

                $user->setPassword($password);
                $user->getUserRoles()->add($role);
                $em->persist($user);
                $em->flush();

                $user = $user_repository->findOneBy(array('username'=>$username));
                $user_id = $user->getId();

                $bookmark = $bookmark_repository->findOneBy(array('id'=>$id));


                $new_bookmark = new TempBookmark();
                $new_bookmark->setIdCategory($bookmark->getIdCategory());
                $new_bookmark->setName($bookmark->getName());
                $new_bookmark->setLink($bookmark->getLink());
                $new_bookmark->setIdUser($user_id);
                $em->persist($new_bookmark);
                $em->flush();

                // send a message (new user)
                $str = $this->renderView(
                    'VladyslavSmartBookmarkBundle:Cabinet:sendList.html.twig',array('bookmarks'=>$bookmarks)
                );
                $email =$form['email']->getData();
                $message = \Swift_Message::newInstance()
                    ->setSubject('smartBookmark - temp bookmark request from friend')
                    ->setFrom(array('smartBookmark2014@gmail.com'=>'smartBookmark'))
                    ->setTo($email)
                    ->setBody("<div style='height:120px;width:320px;
                    background-color:#ff6e22; color:white; font-size:35px;
                    display:table-cell;vertical-align:bottom;'> smartBookmark</div>
                    <div style='background-color:floralwhite;text-align:left;padding-left:5px;color:#CC2900;width:313px; height:150px;
                    border-bottom:3px solid #ff6e22;
                    border-left: 1px dotted #ff6e22;
                    border-right: 1px dotted #ff6e22;'><br>
                        Вітаємо, Вам надіслали закладку! Зайдіть в систему, щоб подивитися:<br><br>
                        логін: $username <br>
                        пароль: $gen_password<br><br>
                        smartBookmark: http://localhost:8000/login
                    </div> "
                        ,'text/html'
                    );

                $this->get('mailer')->send($message);

//                return $this->redirect($this->generateUrl('cabinet'));
            }
            else{

                 $user = $user_repository->findOneBy(array('email'=>$email));
                $user_id = $user->getId();

                $bookmark = $bookmark_repository->findOneBy(array('id'=>$id));



                $new_bookmark = new TempBookmark();
                $new_bookmark->setIdCategory($bookmark->getIdCategory());
                $new_bookmark->setName($bookmark->getName());
                $new_bookmark->setLink($bookmark->getLink());
                $new_bookmark->setIdUser($user_id);
                $em->persist($new_bookmark);
                $em->flush();
                // send a message (bookmark)
                $str = $this->renderView(
                    'VladyslavSmartBookmarkBundle:Cabinet:sendList.html.twig',array('bookmarks'=>$bookmarks)
                );
                $email =$form['email']->getData();
                $message = \Swift_Message::newInstance()
                    ->setSubject('smartBookmark - temp bookmark request from friend')
                    ->setFrom(array('smartBookmark2014@gmail.com'=>'smartBookmark'))
                    ->setTo($email)
                    ->setBody("<div style='height:120px;width:320px;
                    background-color:#ff6e22; color:white; font-size:35px;
                    display:table-cell;vertical-align:bottom;'> smartBookmark</div>
                    <div style='background-color:floralwhite;text-align:left;padding-left:5px;color:#CC2900;width:313px; height:150px;
                    border-bottom:3px solid #ff6e22;
                    border-left: 1px dotted #ff6e22;
                    border-right: 1px dotted #ff6e22;'><br>
                        Вітаємо, Вам надіслали закладку! Зайдіть в систему, щоб подивитися:<br><br>
                        smartBookmark: http://localhost:8000/login
                    </div> "
                        ,'text/html'
                    );

                $this->get('mailer')->send($message);

              return $this->redirect($this->generateUrl('cabinet'));
            }

        }

        return $this->render('VladyslavSmartBookmarkBundle:Cabinet:sendBookmark.html.twig',
            array('form'=>$form->createView()));
    }

    /*
     * Adding of a bookmark
     * */

    public function addBookmarkAction(Request $request){
        $category_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:Category');
        $bookmark_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:Bookmark');
        $em = $this->getDoctrine()->getManager();

        //getting logged user id
        $user = $this->get('security.context')->getToken()->getUser();
        $userId = $user->getId();

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
                    $bookmark->setIdUser($userId);
                    $bookmark->setIdCategory($id_category);
                    $bookmark->setLink($url);
                    $bookmark->setDateTime(new \DateTime());
                    $em->persist($bookmark);
                    $em->flush();
                     return $this->redirect($this->generateUrl('cabinet'));
                }
                else{
//                    echo "<script>alert('hello!');</script>";
                    $id_category = $category->getId();
                    $bookmark = new Bookmark();
                    $bookmark->setName($name);
                    $bookmark->setIdUser($userId);
                    $bookmark->setIdCategory($id_category);
                    $bookmark->setLink($url);
                    $bookmark->setDateTime(new \DateTime());
                    $em->persist($bookmark);
                    $em->flush();
                     return $this->redirect($this->generateUrl('cabinet'));
                }
            }
        }
        return $this->render('VladyslavSmartBookmarkBundle:Cabinet:addBookmark.html.twig',array('form'=>$form->createView()));
    }
}
