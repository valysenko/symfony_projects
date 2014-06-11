<?php

namespace Vladyslav\SmartBookmarkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Vladyslav\SmartBookmarkBundle\Entity\Role;
use Vladyslav\SmartBookmarkBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
class SecurityController extends Controller
{

    public function loginAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

    /*   $role = new Role();
        $role->setName('ROLE_USER');

        $em->persist($role);
        $em->flush();
        // создание пользователя
        $user = new User();
        $user->setUsername('Kiril');
        $user->setEmail('liril@example.com');
        $user->setUsername('user');
        $user->setSalt(md5(time()));

        // шифрует и устанавливает пароль для пользователя,
        // эти настройки совпадают с конфигурационными файлами
        $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
        $password = $encoder->encodePassword('user', $user->getSalt());
        $user->setPassword($password);

        $user->getUserRoles()->add($role);

        $em->persist($user);
        $em->flush();
*/
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContextInterface::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        }

        return $this->render(
            'VladyslavSmartBookmarkBundle:Security:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContextInterface::LAST_USERNAME),
                'error'         => $error,'oop'=>'sss'
            )
        );
    }

    public function registrationAction(Request $request)
    {
        $role_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:Role');
        $user_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:User');
        $em = $this->getDoctrine()->getManager();
//        $role = $user_repository->findOneBy(array('id'=>1));
//        $em->remove($role);
//        $em->flush();
//         var_dump($user_repository->findAll());
         $error_message="";
        $user = new User();
        $form = $this->createFormBuilder($user)
            ->add('username', 'text')
            ->add('password', 'password')
            ->add('confirm_password', 'password',array('mapped'=>false))
            ->add('email', 'email')
            ->add('register', 'submit')
            ->getForm();
        $form->handleRequest($request);



   // var_dump($user_repository->findAll());
        //var_dump($role_repository->findOneBy(array('id'=>1)));
        if($form->isValid()){
            $p=$form['password']->getData();
            $cp = $form['confirm_password']->getData();

            if($p!=$cp){
                $error_message = "Поля пароль та Підтвердження пароля повинні співпадати!";
                return $this->render(
                    'VladyslavSmartBookmarkBundle:Security:registration.html.twig',array('form'=>$form->createView(),
                        'error_message'=>$error_message)

                );
            }

         $roles = $role_repository->findOneBy(array('id'=>1));
            $role = new Role();
            $role->setName('ROLE_USER');
          if($roles==null){

                $em->persist($role);
                $em->flush();

           }

            $user->setUsername($form['username']->getData());
            $user->setEmail($form['email']->getData());
            $user->setSalt(md5(time()));
            $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
            $password = $encoder->encodePassword($form['password']->getData(), $user->getSalt());
            $user->setPassword($password);
            $user->getUserRoles()->add($role);
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('index_page'));
        }
        return $this->render(
            'VladyslavSmartBookmarkBundle:Security:registration.html.twig',array('form'=>$form->createView(),
                'error_message'=>$error_message)

        );
    }

    public function restorePasswordAction(Request $request){
        $user_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:User');
        $roles_repository = $this->getDoctrine()
            ->getRepository('VladyslavSmartBookmarkBundle:Role');
        $em = $this->getDoctrine()->getManager();

        $user = new User();
        $form = $this->createFormBuilder($user)
            ->add('email','email')
            ->add('restore', 'submit')
            ->getForm();
        $form->handleRequest($request);

        $translated = $this->get('translator')->
            trans('Вітаємо, Ваші нові дані для доступу в систему');

        $translated_subject = $this->get('translator')->
            trans('Відновлення пароля');

        $log = $this->get('translator')->
            trans('логін');

        $passw = $this->get('translator')->
            trans('пароль');
        if($form->isValid()){
            $user = $user_repository->findOneBy(array('email'=>$form['email']->getData()));
            if($user!=null){
                //generating new password
                $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
                $numChars = strlen($chars);
                $gen_password= '';
                for ($i = 0; $i < 10; $i++) {
                    $gen_password .= substr($chars, rand(1, $numChars) - 1, 1);
                }

                // updating user
                $role = $roles_repository->findOneBy(array('id'=>1));
//                $user = new User();
                $user->setSalt(md5(time()));
                $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
                $password = $encoder->encodePassword($gen_password, $user->getSalt());
                 $user->setPassword($password);
                $em->persist($user);
                $em->flush();
                $username = $user->getUsername();
                //sending password

                $email =$form['email']->getData();
                $message = \Swift_Message::newInstance()
                    ->setSubject("smartBookmark - $translated_subject")
                    ->setFrom(array('smartBookmark2014@gmail.com'=>'smartBookmark'))
                    ->setTo($email)
                    ->setBody("<div style='height:120px;width:320px;
                    background-color:#ff6e22; color:white; font-size:35px;
                    display:table-cell;vertical-align:bottom;'> smartBookmark</div>
                    <div style='background-color:floralwhite;text-align:left;padding-left:5px;color:#CC2900;width:313px; height:150px;
                    border-bottom:3px solid #ff6e22;
                    border-left: 1px dotted #ff6e22;
                    border-right: 1px dotted #ff6e22;'><br>
                        $translated:<br><br>
                        $log: $username <br>
                        $passw: $gen_password<br><br>
                        smartBookmark: http://localhost:8000/login
                    </div> "
                        ,'text/html'
                    );

                $this->get('mailer')->send($message);

                return $this->redirect($this->generateUrl('cabinet'));
            }
        }
        return $this->render(
            'VladyslavSmartBookmarkBundle:Security:restorePassword.html.twig',array('form'=>$form->createView())
        );

    }


}
