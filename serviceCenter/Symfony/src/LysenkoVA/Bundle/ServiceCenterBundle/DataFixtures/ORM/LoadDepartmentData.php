<?php
/**
 * Created by PhpStorm.
 * User: vladyslav
 * Date: 09.03.15
 * Time: 15:27
 */

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use \LysenkoVA\Bundle\ServiceCenterBundle\Entity\Department;


class LoadDepartmentData implements FixtureInterface, \Doctrine\Common\DataFixtures\OrderedFixtureInterface{

    function load(ObjectManager $manager)
    {
       $department1 = new Department();
       $department1->setAddress('Kiev, Tsvetaevoi St, 14-B');
       $department1->setTelephoneNumber('0442658694');
       $manager->persist($department1);

        $department2 = new Department();
       $department2->setAddress('Kiev, Kudri St, 31-A');
       $department2->setTelephoneNumber('0442656835');
       $manager->persist($department2);

       $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}