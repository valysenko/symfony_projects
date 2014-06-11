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
use Vladyslav\SmartBookmarkBundle\Entity\BookmarkQuantity;
use Vladyslav\SmartBookmarkBundle\Entity\Category;
use Vladyslav\SmartBookmarkBundle\Entity\User;
use Vladyslav\SmartBookmarkBundle\Entity\Role;
use Doctrine\ORM\Tools\Pagination\Paginator;

class CabinetController extends Controller
{

    /*
     * temp bookmarks of the user
     * */
    public function responsedBookmarksAction(Request $request, $page)
    {
        $tempBookmark_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:TempBookmark');
        //getting logged user id
        $user = $this->get('security.context')->getToken()->getUser();
        $userId = $user->getId();

        $bookmarks = $tempBookmark_repository->findBy(array('idUser' => $userId));
        $count = count($bookmarks);

        $em = $this->getDoctrine()->getManager();

        //count of pages
        $quantityOfPages = $count / 9;

        //limited query
        $dql = "SELECT p FROM VladyslavSmartBookmarkBundle:TempBookmark p where p.idUser=$userId";
        $query = $em->createQuery($dql)
            ->setFirstResult(($page - 1) * 9)
            ->setMaxResults($page * 9);

        $paginator = new Paginator($query);

        return $this->render('VladyslavSmartBookmarkBundle:Cabinet:responsedBookmarks.html.twig', array('bookmarks' => $paginator,
            'count' => $count, 'quantityOfPages' => $quantityOfPages));
    }

    public function cabinetAction(Request $request, $page, $category_id)
    {

        $category_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:Category');
        $bookmark_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:Bookmark');
        $user_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:User');
        $em = $this->getDoctrine()->getManager();

        $categories = $category_repository->findAll();

        //getting logged user id
        $user = $this->get('security.context')->getToken()->getUser();
        $userId = $user->getId();

        //count of responsed
        $tempBookmark_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:TempBookmark');
        $count = count($tempBookmark_repository->findBy(array('idUser' => $userId)));

        if ($category_id == 0)
            $bookmarks = $bookmark_repository->findBy(array('idUser' => $userId));
        else
            $bookmarks = $bookmark_repository->findBy(array('idUser' => $userId, 'idCategory' => $category_id));
        //quantity of bookmarks
        $quantity = count($bookmarks);
        $quantityOfPages = $quantity / 9;

        //limited query
        if ($category_id == 0)
            $dql = "SELECT p FROM VladyslavSmartBookmarkBundle:Bookmark p
            where p.idUser=$userId";
        else
            $dql = "SELECT p FROM VladyslavSmartBookmarkBundle:Bookmark p
            where p.idUser=$userId and p.idCategory=$category_id";
        $query = $em->createQuery($dql)
            ->setFirstResult(($page - 1) * 9)
            ->setMaxResults(9);

        $paginator = new Paginator($query);
//        var_dump(count($paginator));
//        $paginator = $query->getResult();
//        var_dump($page);
        return $this->render('VladyslavSmartBookmarkBundle:Cabinet:cabinet.html.twig', array('bookmarks' => $paginator,
            'count' => $count, 'quantityOfPages' => $quantityOfPages, 'categories' => $categories, 'page' => $page));
    }


    /*
     * Sending a bookmark
     * */

    public function sendBookmarkAction(Request $request, $id)
    {
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

        //getting logged user id
        $user = $this->get('security.context')->getToken()->getUser();
        $userId = $user->getId();
        //count of responsed
        $count = count($tempBookmark_repository->findBy(array('idUser' => $userId)));


        $user = new User();
        $form = $this->createFormBuilder($user)
            ->add('email', 'email')
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
        if ($form->isValid()) {

            $email = $form['email']->getData();
            $user = $user_repository->findOneBy(array('email' => $email));

            if ($user == null) {
                //1
                $findme = '@';
                $pos = strpos($email, $findme);
                $username = substr($email, 0, $pos);

                //2
                $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
                $numChars = strlen($chars);
                $gen_password = '';
                for ($i = 0; $i < 10; $i++) {
                    $gen_password .= substr($chars, rand(1, $numChars) - 1, 1);
                }

                //3
                $role = $roles_repository->findOneBy(array('id' => 1));
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

                $user = $user_repository->findOneBy(array('username' => $username));
                $user_id = $user->getId();

                $bookmark = $bookmark_repository->findOneBy(array('id' => $id));


                $new_bookmark = new TempBookmark();
                $new_bookmark->setIdCategory($bookmark->getIdCategory());
                $new_bookmark->setName($bookmark->getName());
                $new_bookmark->setDescription($bookmark->getDescription());
                $new_bookmark->setLink($bookmark->getLink());
                $new_bookmark->setIdUser($user_id);
                $em->persist($new_bookmark);
                $em->flush();

                $translated = $this->get('translator')->
                trans('Вітаємо, Вам надіслали закладку! Зайдіть в систему, щоб подивитися');
                $translated_subject = $this->get('translator')->
                trans('Нова закладка');
                $log = $this->get('translator')->
                trans('логін');

                $passw = $this->get('translator')->
                trans('пароль');
                $email = $form['email']->getData();
                $message = \Swift_Message::newInstance()
                    ->setSubject("smartBookmark - $translated_subject")
                    ->setFrom(array('smartBookmark2014@gmail.com' => 'smartBookmark'))
                    ->setTo($email)
                    ->setBody("<div style='height:120px;width:320px;
                    background-color:#ff6e22; color:white; font-size:35px;
                    display:table-cell;vertical-align:bottom;'> smartBookmark</div>
                    <div style='background-color:floralwhite;text-align:left;padding-left:5px;color:#CC2900;width:313px; height:150px;
                    border-bottom:3px solid #ff6e22;
                    border-left: 1px dotted #ff6e22;
                    border-right: 1px dotted #ff6e22;'><br>$translated:<br><br>
                        $log: $username <br>
                        $passw: $gen_password<br><br>
                        smartBookmark: http://localhost:8000/login
                    </div> "
                        , 'text/html'
                    );

                $this->get('mailer')->send($message);

                return $this->redirect($this->generateUrl('cabinet'));
            } else {

                $user = $user_repository->findOneBy(array('email' => $email));
                $user_id = $user->getId();

                $bookmark = $bookmark_repository->findOneBy(array('id' => $id));


                $new_bookmark = new TempBookmark();
                $new_bookmark->setIdCategory($bookmark->getIdCategory());
                $new_bookmark->setName($bookmark->getName());
                $new_bookmark->setDescription($bookmark->getDescription());
                $new_bookmark->setLink($bookmark->getLink());
                $new_bookmark->setIdUser($user_id);
                $em->persist($new_bookmark);
                $em->flush();

                $translated = $this->get('translator')->
                trans('Вітаємо, Вам надіслали закладку! Зайдіть в систему, щоб подивитися');
                $translated_subject = $this->get('translator')->
                trans('Нова закладка');
                $email = $form['email']->getData();
                $message = \Swift_Message::newInstance()
                    ->setSubject("smartBookmark - $translated_subject")
                    ->setFrom(array('smartBookmark2014@gmail.com' => 'smartBookmark'))
                    ->setTo($email)
                    ->setBody("<div style='height:120px;width:320px;
                    background-color:#ff6e22; color:white; font-size:35px;
                    display:table-cell;vertical-align:bottom;'> smartBookmark</div>
                    <div style='background-color:floralwhite;text-align:left;padding-left:5px;color:#CC2900;width:313px; height:150px;
                    border-bottom:3px solid #ff6e22;
                    border-left: 1px dotted #ff6e22;
                    border-right: 1px dotted #ff6e22;'><br>$translated

                        <br><br>
                        smartBookmark: http://localhost:8000/login
                    </div> "
                        , 'text/html'
                    );

                $this->get('mailer')->send($message);

                return $this->redirect($this->generateUrl('cabinet'));
            }

        }

        return $this->render('VladyslavSmartBookmarkBundle:Cabinet:sendBookmark.html.twig',
            array('form' => $form->createView(), 'count' => $count));
//         return $this->redirect($this->generateUrl('cabinet'));
    }

    /*
     * Adding of a bookmark
     * */

    public function addBookmarkAction(Request $request)
    {
        $category_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:Category');
        $bookmark_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:Bookmark');
        $bookmarkQuantity_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:BookmarkQuantity');
        $em = $this->getDoctrine()->getManager();

        //getting logged user id
        $user = $this->get('security.context')->getToken()->getUser();
        $userId = $user->getId();

//        $p = $bookmark_repository->findAll();
//        var_dump($p);


        //count of responsed
        $tempBookmark_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:TempBookmark');
        $count = count($tempBookmark_repository->findBy(array('idUser' => $userId)));

        $bookmark = new Bookmark();
        $form = $this->createForm(new BookmarkType(), $bookmark);
        $form->handleRequest($request);
        if ($form->isValid()) {
            if ($form->get('add')->isClicked()) {
                $name = $form["name"]->getData();
                $url = $form["link"]->getData();
                $category_name = $form["category"]->getData();
                $category = $category_repository
                    ->findOneBy(array('name' => $category_name));
                /*
                 * adding category if is not exists
                 * */
                if (!$category) {
                    $c = new Category();
                    $c->setName($category_name);
                    $em->persist($c);
                    $em->flush();

                    $categ = $category_repository
                        ->findOneBy(array('name' => $category_name));
                    $id_category = $categ->getId();

                    $bookmark = new Bookmark();
                    $bookmark->setName($name);
                    $bookmark->setIdUser($userId);
                    $bookmark->setIdCategory($id_category);
                    $bookmark->setLink($url);
                    $bookmark->setDescription($form["description"]->getData());
                    $bookmark->setDateTime(new \DateTime());
                    $em->persist($bookmark);
                    $em->flush();

                    //incrementing quantity of bookmark with such URL int the bookmarkquantity table
                    $this_bookmark = $bookmarkQuantity_repository->findOneBy(array('link' => $bookmark->getLink()));
                    if ($this_bookmark != null) {
                        $this_bookmark->setQuantity(($this_bookmark->getQuantity()) + 1);
                        $em->persist($this_bookmark);
                        $em->flush();
                    } else {
                        $this_bookmark = new BookmarkQuantity();
                        $this_bookmark->setLink($bookmark->getLink());
                        $this_bookmark->setQuantity(1);
                        $this_bookmark->setIdCategory($bookmark->getIdCategory());
                        $em->persist($this_bookmark);
                        $em->flush();
                    }

                    return $this->redirect($this->generateUrl('cabinet'));
                } else {
//                    echo "<script>alert('hello!');</script>";
                    $id_category = $category->getId();
                    $bookmark = new Bookmark();
                    $bookmark->setName($name);
                    $bookmark->setIdUser($userId);
                    $bookmark->setIdCategory($id_category);
                    $bookmark->setDescription($form["description"]->getData());
                    $bookmark->setLink($url);
                    $bookmark->setDateTime(new \DateTime());
                    $em->persist($bookmark);
                    $em->flush();

                    //incrementing quantity of bookmark with such URL int the bookmarkquantity table
                    $this_bookmark = $bookmarkQuantity_repository->findOneBy(array('link' => $bookmark->getLink()));
                    if ($this_bookmark != null) {
                        $this_bookmark->setQuantity(($this_bookmark->getQuantity()) + 1);
                        $em->persist($this_bookmark);
                        $em->flush();
                    } else {
                        $this_bookmark = new BookmarkQuantity();
                        $this_bookmark->setLink($bookmark->getLink());
                        $this_bookmark->setQuantity(1);
                        $this_bookmark->setIdCategory($bookmark->getIdCategory());
                        $em->persist($this_bookmark);
                        $em->flush();
                    }
                    return $this->redirect($this->generateUrl('cabinet'));
                }
            }
        }
        return $this->render('VladyslavSmartBookmarkBundle:Cabinet:addBookmark.html.twig', array('form' => $form->createView(), 'count' => $count));
        //return $this->redirect($this->generateUrl('cabinet'));
    }

    public function deleteBookmarkAction(Request $request, $id)
    {
        $bookmark_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:Bookmark');
        $temp_bookmark_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:TempBookmark');
        $bookmarkQuantity_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:BookmarkQuantity');
        $em = $this->getDoctrine()->getManager();
        $bookmark = $bookmark_repository->findOneBy(array('id' => $id));
        $em->remove($bookmark);
        $em->flush();

        //deleating bookmark with such url from bookmarkquantity table
        $this_bookmark = $bookmarkQuantity_repository->findOneBy(array('link' => $bookmark->getLink()));

        $this_bookmark->setQuantity(($this_bookmark->getQuantity()) - 1);
        $em->persist($this_bookmark);
        $em->flush();


        $user = $this->get('security.context')->getToken()->getUser();
        $userId = $user->getId();

        $bookmarks = $bookmark_repository->findBy(array('idUser' => $userId));

        $temp_bookmarks = $temp_bookmark_repository->findBy(array('idUser' => $userId));
        $count = count($temp_bookmarks);

        //  return $this->render('VladyslavSmartBookmarkBundle:Cabinet:cabinet.html.twig',array('bookmarks'=>$bookmarks,'count'=>$count));
        return $this->redirect($this->generateUrl('cabinet'));
    }

    public function addResponsedBookmarkAction(Request $request, $id)
    {
        $bookmarkQuantity_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:BookmarkQuantity');

        $temp_bookmark_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:TempBookmark');
        $bookmark_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:Bookmark');
        $em = $this->getDoctrine()->getManager();
        $temp_bookmark = $temp_bookmark_repository->findOneBy(array('id' => $id));


        $user = $this->get('security.context')->getToken()->getUser();
        $userId = $user->getId();


        $bookmark = new Bookmark();
        $bookmark->setName($temp_bookmark->getName());
        $bookmark->setIdUser($userId);
        $bookmark->setIdCategory($temp_bookmark->getIdCategory());
        $bookmark->setDescription($temp_bookmark->getDescription());
        $bookmark->setLink($temp_bookmark->getLink());
        $bookmark->setDateTime(new \DateTime());
        $em->persist($bookmark);
        $em->flush();

        //decrementing quantity of bookmark with such URL int the bookmarkquantity table
        $this_bookmark = $bookmarkQuantity_repository->findOneBy(array('link' => $bookmark->getLink()));
        if ($this_bookmark != null) {
            $this_bookmark->setQuantity(($this_bookmark->getQuantity()) + 1);
            $em->persist($this_bookmark);
            $em->flush();
        } else {
            $this_bookmark = new BookmarkQuantity();
            $this_bookmark->setLink($bookmark->getLink());
            $this_bookmark->setQuantity(1);
            $this_bookmark->setIdCategory($bookmark->getIdCategory());
            $em->persist($this_bookmark);
            $em->flush();
        }

        //remove bookmark from tempbookmark table
        $em->remove($temp_bookmark);
        $em->flush();
        return $this->redirect($this->generateUrl('responsed_bookmarks'));
    }

    public function deleteResponsedBookmarkAction(Request $request, $id)
    {
        $temp_bookmark_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:TempBookmark');
        $em = $this->getDoctrine()->getManager();

        $bookmark = $temp_bookmark_repository->findOneBy(array('id' => $id));
        $em->remove($bookmark);
        $em->flush();

        return $this->redirect($this->generateUrl('responsed_bookmarks'));
    }

    public function editUserAction(Request $request)
    {
        $tempBookmark_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:TempBookmark');
        $user_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:User');
        $em = $this->getDoctrine()->getManager();
        //getting logged user id
        $user = $this->get('security.context')->getToken()->getUser();
        $userId = $user->getId();
        $name = $user->getUsername();
        $password = $user->getPassword();
        $email = $user->getEmail();
        $bookmarks = $tempBookmark_repository->findBy(array('idUser' => $userId));
        $count = count($bookmarks);

        $user = new User();
        $form = $this->createFormBuilder($user)
            ->add('username', 'text')
//            ->add('password', 'text')
            ->add('email', 'email')
            ->add('save', 'submit')
            ->getForm();
        $form->handleRequest($request);
        $first_user = $user_repository->findOneBy(array('id' => $userId));
        if ($form->isValid()) {
            $first_user->setUsername($form['username']->getData());
            $first_user->setEmail($form['email']->getData());
            $em->persist($first_user);
            $em->flush();
            return $this->redirect($this->generateUrl('cabinet'));
        }
        return $this->render('VladyslavSmartBookmarkBundle:Cabinet:editUser.html.twig', array('form' => $form->createView(),
            'count' => $count, 'user' => $user, 'email' => $email,
            'username' => $name));
        // ,'password'=>$password));
    }

    public function popularAction(Request $request,$category_id)
    {
        $bookmarkQuantity_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:BookmarkQuantity');

        $temp_bookmark_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:TempBookmark');
        $bookmark_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:Bookmark');
        $em = $this->getDoctrine()->getManager();

        $category_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:Category');

        //getting logged user id
        $user = $this->get('security.context')->getToken()->getUser();
        $userId = $user->getId();

        $categories = $category_repository->findAll();

        $bookmarks = $temp_bookmark_repository->findBy(array('idUser' => $userId));
        $count = count($bookmarks);


//        $bookmark_quantity = $bookmarkQuantity_repository->findAll(array('quantity' => 'ASC'));

        $bookmarks=array();
        $quantity = 0;
        if($category_id==0){
            $query = $em->createQuery('SELECT a FROM VladyslavSmartBookmarkBundle:BookmarkQuantity a  ORDER BY a.quantity DESC');
            $bookmark_quantity = $query->getResult(); // массих объектов CmsArticle
            foreach($bookmark_quantity as $bq){
                $bookmarks[] = $bookmark_repository->findOneBy(array('link'=>$bq->getLink()));
    //            echo $bq->getQuantity().PHP_EOL;
                $quantity++;
                if($quantity==6)
                    break;
            }
        }
        else{
            $query = $em->createQuery("SELECT a FROM VladyslavSmartBookmarkBundle:BookmarkQuantity a WHERE a.id_category=$category_id  ORDER BY a.quantity DESC");
            $bookmark_quantity = $query->getResult(); // массих объектов CmsArticle
            foreach($bookmark_quantity as $bq){
                $bookmarks[] = $bookmark_repository->findOneBy(array('link'=>$bq->getLink()));
                //            echo $bq->getQuantity().PHP_EOL;
                $quantity++;
                if($quantity==6)
                    break;
            }
        }
        return $this->render('VladyslavSmartBookmarkBundle:Cabinet:popular.html.twig',
            array('count' => $count, 'bookmarks' => $bookmarks,'categories'=>$categories));

    }

    public function addAllAction(Request $request){
        $bookmarkQuantity_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:BookmarkQuantity');

        $temp_bookmark_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:TempBookmark');
        $bookmark_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:Bookmark');

        //getting logged user id
        $user = $this->get('security.context')->getToken()->getUser();
        $userId = $user->getId();

        $em = $this->getDoctrine()->getManager();
        $bookmarks = $temp_bookmark_repository->findBy(array('idUser'=>$userId));
        if($bookmarks!=null){
            foreach($bookmarks as $temp_bookmark){
                $bookmark = new Bookmark();
                $bookmark->setName($temp_bookmark->getName());
                $bookmark->setIdUser($userId);
                $bookmark->setIdCategory($temp_bookmark->getIdCategory());
                $bookmark->setDescription($temp_bookmark->getDescription());
                $bookmark->setLink($temp_bookmark->getLink());
                $bookmark->setDateTime(new \DateTime());
                $em->persist($bookmark);
                $em->flush();

                //decrementing quantity of bookmark with such URL int the bookmarkquantity table
                $this_bookmark = $bookmarkQuantity_repository->findOneBy(array('link' => $bookmark->getLink()));
                if ($this_bookmark != null) {
                    $this_bookmark->setQuantity(($this_bookmark->getQuantity()) + 1);
                    $em->persist($this_bookmark);
                    $em->flush();
                } else {
                    $this_bookmark = new BookmarkQuantity();
                    $this_bookmark->setLink($bookmark->getLink());
                    $this_bookmark->setQuantity(1);
                    $this_bookmark->setIdCategory($bookmark->getIdCategory());
                    $em->persist($this_bookmark);
                    $em->flush();
                }
                $em->remove($temp_bookmark);
                $em->flush();
            }
//            $em->flush();
        }
        return $this->redirect($this->generateUrl('cabinet'));
    }

    public function deleteAllAction(Request $request){
        $temp_bookmark_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:TempBookmark');
        $em = $this->getDoctrine()->getManager();
        //getting logged user id
        $user = $this->get('security.context')->getToken()->getUser();
        $userId = $user->getId();
        $bookmarks = $temp_bookmark_repository->findBy(array('idUser'=>$userId));
        if($bookmarks!=null){
            foreach($bookmarks as $bookmark){
                $em->remove($bookmark);
            }
            $em->flush();
        }
        return $this->redirect($this->generateUrl('cabinet'));
    }
}