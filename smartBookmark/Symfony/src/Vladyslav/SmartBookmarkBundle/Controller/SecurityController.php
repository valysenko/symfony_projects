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
            'VladyslavSmartBookmarkBundle:Security:registration.html.twig',array('form'=>$form->createView())

        );
    }


}
