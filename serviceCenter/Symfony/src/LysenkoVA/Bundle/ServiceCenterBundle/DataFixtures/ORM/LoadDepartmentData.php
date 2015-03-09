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
       $department = new Department();
       $department->setAddress('Kiev, Tsvetaevoi St, 14-B');
       $department->setTelephoneNumber('0442658694');
       $manager->persist($department);
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