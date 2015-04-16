<?php
/**
 * Created by PhpStorm.
 * User: vladyslav
 * Date: 09.03.15
 * Time: 15:09
 */
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use \LysenkoVA\Bundle\ServiceCenterBundle\Entity\Role;
use \LysenkoVA\Bundle\ServiceCenterBundle\Entity\Employee;

class LoadUserData implements FixtureInterface, \Doctrine\Common\DataFixtures\OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        /**
         * 1. Creating roles for all users(manager, master and admin)
         */

//        //role manager
//        $role_employee = new Role();
//        $role_employee->setName('ROLE_MANAGER');
//
//        //role master
//        $role_master = new Role();
//        $role_master->setName('ROLE_MASTER');
//
//        //role manager
//        $role_admin= new Role();
//        $role_admin->setName('ROLE_ADMIN');
//
//        $manager->persist($role_employee);
//        $manager->persist($role_master);
//        $manager->persist($role_admin);
//        $manager->flush();

        /**
         * 2. Getting departments
         */
        //getting department
        $department_repository = $manager
            ->getRepository('LysenkoVAServiceCenterBundle:Department');
        $department1 = $department_repository->find(1);
        $department2 = $department_repository->find(2);

        /**
         * 3. Creating users for every department( 2 masters and 2 managers)
         */
        //manager 1 (department 1)
        $user = new Employee();
        $user->setUsername('manager11');
        $user->setFirstName('Vladyslav');
        $user->setSurname('Vladyslavov');
        $user->setSalt(md5(time()));
        $user->setTelephoneNumber('1111111111');
        $user->setDepartment($department1);
        $encoder = new \Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder('sha512', true, 10);
        $password = $encoder->encodePassword('1', $user->getSalt());
        $user->setPassword($password);
        $user->setRoles('ROLE_MANAGER');
        $manager->persist($user);


        //manager 2 (department 1)
        $user2 = new Employee();
        $user2->setUsername('manager21');
        $user2->setFirstName('Ivan');
        $user2->setSurname('Petrenko');
        $user2->setSalt(md5(time()));
        $user2->setTelephoneNumber('2222222333');
        $user2->setDepartment($department1);
        $encoder = new \Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder('sha512', true, 10);
        $password = $encoder->encodePassword('1', $user2->getSalt());
        $user2->setPassword($password);
        $user2->setRoles('ROLE_MANAGER');
        $manager->persist($user2);


        //master 1 (department 1)
        $user3 = new Employee();
        $user3->setUsername('master11');
        $user3->setFirstName('Oleg');
        $user3->setSurname('Olegov');
        $user3->setSalt(md5(time()));
        $user3->setTelephoneNumber('1111111444');
        $user3->setDepartment($department1);
        $encoder = new \Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder('sha512', true, 10);
        $password = $encoder->encodePassword('1', $user3->getSalt());
        $user3->setPassword($password);
        $user3->setRoles('ROLE_MASTER');
        $manager->persist($user3);


        //master 2 (department 1)
        $user4 = new Employee();
        $user4->setUsername('master21');
        $user4->setFirstName('Pavel');
        $user4->setSurname('Pavlov');
        $user4->setSalt(md5(time()));
        $user4->setTelephoneNumber('2222222864');
        $user4->setDepartment($department1);
        $encoder = new \Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder('sha512', true, 10);
        $password = $encoder->encodePassword('1', $user4->getSalt());
        $user4->setPassword($password);
        $user4->setRoles('ROLE_MASTER');
        $manager->persist($user4);

        //manager 1 (department 2)
        $user5 = new Employee();
        $user5->setUsername('manager12');
        $user5->setFirstName('Vladymir');
        $user5->setSurname('Vladimirov');
        $user5->setSalt(md5(time()));
        $user5->setTelephoneNumber('3123215111');
        $user5->setDepartment($department2);
        $encoder = new \Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder('sha512', true, 10);
        $password = $encoder->encodePassword('1', $user5->getSalt());
        $user5->setPassword($password);
        $user5->setRoles('ROLE_MANAGER');
        $manager->persist($user5);


        //manager 2 (department 2)
        $user6 = new Employee();
        $user6->setUsername('manager22');
        $user6->setFirstName('Valentyn');
        $user6->setSurname('Valentynov');
        $user6->setSalt(md5(time()));
        $user6->setTelephoneNumber('9283222333');
        $user6->setDepartment($department2);
        $encoder = new \Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder('sha512', true, 10);
        $password = $encoder->encodePassword('1', $user6->getSalt());
        $user6->setPassword($password);
        $user6->setRoles('ROLE_MANAGER');
        $manager->persist($user6);


        //master 1 (department 2)
        $user7 = new Employee();
        $user7->setUsername('master12');
        $user7->setFirstName('Anrdrey');
        $user7->setSurname('Andreev');
        $user7->setSalt(md5(time()));
        $user7->setTelephoneNumber('6671111444');
        $user7->setDepartment($department2);
        $encoder = new \Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder('sha512', true, 10);
        $password = $encoder->encodePassword('1', $user7->getSalt());
        $user7->setPassword($password);
        $user7->setRoles('ROLE_MASTER');
        $manager->persist($user7);


        //master 2 (department 2)
        $user8 = new Employee();
        $user8->setUsername('master22');
        $user8->setFirstName('Vadim');
        $user8->setSurname('Vadimov');
        $user8->setSalt(md5(time()));
        $user8->setTelephoneNumber('2021922864');
        $user8->setDepartment($department2);
        $encoder = new \Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder('sha512', true, 10);
        $password = $encoder->encodePassword('1', $user8->getSalt());
        $user8->setPassword($password);
        $user8->setRoles('ROLE_MASTER');
        $manager->persist($user8);



        /**
         * 4. Creating CEO of Service center
         */

        //admin
        $userAdmin = new Employee();
        $userAdmin->setUsername('valysenko');
        $userAdmin->setFirstName('Vladyslav');
        $userAdmin->setSurname('Lysenko');
        $userAdmin->setSalt(md5(time()));
        $userAdmin->setTelephoneNumber('0958796883');
        $encoder = new \Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder('sha512', true, 10);
        $password = $encoder->encodePassword('1', $userAdmin->getSalt());
        $userAdmin->setPassword($password);
        $userAdmin->setRoles('ROLE_ADMIN');
        $manager->persist($userAdmin);


        $department1->addEmployee($user);
        $department1->addEmployee($user2);
        $department1->addEmployee($user3);
        $department1->addEmployee($user4);
        $department2->addEmployee($user5);
        $department2->addEmployee($user6);
        $department2->addEmployee($user7);
        $department2->addEmployee($user8);
        $manager->persist($department1);
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}