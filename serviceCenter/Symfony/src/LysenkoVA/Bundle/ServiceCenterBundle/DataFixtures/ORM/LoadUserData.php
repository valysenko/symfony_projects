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
        //role user
        $role_employee = new Role();
        $role_employee->setName('ROLE_USER');

        //role manager
        $role_manager= new Role();
        $role_manager->setName('ROLE_ADMIN');

        $manager->persist($role_employee);
        $manager->persist($role_manager);
        $manager->flush();

        //getting department
        $department_repository = $manager
            ->getRepository('LysenkoVAServiceCenterBundle:Department');
        $department = $department_repository->find(1);

        //user 1
        $user = new Employee();
        $user->setUsername('user1');
        $user->setFirstName('Vladyslav');
        $user->setSurname('Vladyslavov');
        $user->setSalt(md5(time()));
        $user->setTelephoneNumber('1111111111');
        $user->setDepartment($department);
        $encoder = new \Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder('sha512', true, 10);
        $password = $encoder->encodePassword('1', $user->getSalt());
        $user->setPassword($password);
        $user->addUserRole($role_employee);
        $manager->persist($user);
        $manager->flush();

        //user 2
        $user2 = new Employee();
        $user2->setUsername('user2');
        $user2->setFirstName('Ivan');
        $user2->setSurname('Petrenko');
        $user2->setSalt(md5(time()));
        $user2->setTelephoneNumber('2222222222');
        $user2->setDepartment($department);
        $encoder = new \Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder('sha512', true, 10);
        $password = $encoder->encodePassword('1', $user2->getSalt());
        $user2->setPassword($password);
        $user2->addUserRole($role_employee);
        $manager->persist($user2);
        $manager->flush();

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
        $userAdmin->addUserRole($role_manager);
        $manager->persist($userAdmin);
        $manager->flush();

        $department->addEmployee($user);
        $department->addEmployee($user2);
        $manager->persist($department);
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