<?php
/**
 * Created by PhpStorm.
 * User: vladyslav
 * Date: 13.03.15
 * Time: 19:00
 */
use \LysenkoVA\Bundle\ServiceCenterBundle\Entity\Category;
use \LysenkoVA\Bundle\ServiceCenterBundle\Entity\Service;
class LoadCatedoryAndServiceData  implements \Doctrine\Common\DataFixtures\FixtureInterface, \Doctrine\Common\DataFixtures\OrderedFixtureInterface{

    /**
     * {@inheritDoc}
     */
    function load(\Doctrine\Common\Persistence\ObjectManager $manager)
    {
        // category diagnostics and services for it
        $category1 = new Category();
        $category1->setName("Diagnostics");

        $service11 = new Service();
        $service11->setPrice(300);
        $service11->setName('Notebook diagnostics');
        $service11->setCategory($category1);

        $service12 = new Service();
        $service12->setPrice(250);
        $service12->setName('Smartphone/telephone diagnostics');
        $service12->setCategory($category1);

        $service13 = new Service();
        $service13->setPrice(200);
        $service13->setName('Component diagnostics');
        $service13->setCategory($category1);

        $category1->addService($service11);
        $category1->addService($service12);
        $category1->addService($service13);

        $manager->persist($category1);
        $manager->persist($service11);
        $manager->persist($service12);
        $manager->persist($service13);

        // category repair and services for it
        $category2 = new Category();
        $category2->setName("Repair");

        $service21 = new Service();
        $service21->setPrice(300);
        $service21->setName('Repairing component');
        $service21->setCategory($category2);

        $service22 = new Service();
        $service22->setPrice(600);
        $service22->setName('Repairing screen');
        $service22->setCategory($category2);

        $service25 = new Service();
        $service25->setPrice(450);
        $service25->setName('Repairing battery');
        $service25->setCategory($category2);

        $service28 = new Service();
        $service28->setPrice(500);
        $service28->setName('Repairing power supply unit');
        $service28->setCategory($category2);

        $service26 = new Service();
        $service26->setPrice(800);
        $service26->setName('Repairing hard drive');
        $service26->setCategory($category2);

        $service23 = new Service();
        $service23->setPrice(250);
        $service23->setName('Changing component');
        $service23->setCategory($category2);

        $service24 = new Service();
        $service24->setPrice(800);
        $service24->setName('Changing screen');
        $service24->setCategory($category2);

        $service27 = new Service();
        $service27->setPrice(1500);
        $service27->setName('Changing hard drive');
        $service27->setCategory($category2);

        $service29 = new Service();
        $service29->setPrice(500);
        $service29->setName('Changing power supply unit');
        $service29->setCategory($category2);

        $category2->addService($service21);
        $category2->addService($service22);
        $category2->addService($service23);
        $category2->addService($service25);
        $category2->addService($service26);
        $category2->addService($service27);
        $category2->addService($service28);
        $category2->addService($service29);

        $manager->persist($category2);
        $manager->persist($service21);
        $manager->persist($service22);
        $manager->persist($service23);
        $manager->persist($service24);
        $manager->persist($service25);
        $manager->persist($service26);
        $manager->persist($service27);
        $manager->persist($service28);
        $manager->persist($service29);

        // category repair and services for it
        $category3 = new Category();
        $category3->setName("Handling");

        $service31 = new Service();
        $service31->setPrice(300);
        $service31->setName('Cleaning notebook');
        $service31->setCategory($category3);

        $service41 = new Service();
        $service41->setPrice(400);
        $service41->setName('Cleaning phone');
        $service41->setCategory($category3);

        $service51 = new Service();
        $service51->setPrice(200);
        $service51->setName('Cleaning keyboard');
        $service51->setCategory($category3);

        $service61 = new Service();
        $service61->setPrice(100);
        $service61->setName('Cleaning component');
        $service61->setCategory($category3);

        $service91 = new Service();
        $service91->setPrice(100);
        $service91->setName('Changing thermal compound');
        $service91->setCategory($category3);

        $service71 = new Service();
        $service71->setPrice(200);
        $service71->setName('Updating and cleaning operating system');
        $service71->setCategory($category3);

        $service81 = new Service();
        $service81->setPrice(350);
        $service81->setName('Installing operating system');
        $service81->setCategory($category3);

        $category3->addService($service31);
        $category3->addService($service41);
        $category3->addService($service51);
        $category3->addService($service61);
        $category3->addService($service71);
        $category3->addService($service81);
        $category3->addService($service91);

        $manager->persist($category3);
        $manager->persist($service31);
        $manager->persist($service41);
        $manager->persist($service51);
        $manager->persist($service61);
        $manager->persist($service71);
        $manager->persist($service81);
        $manager->persist($service91);

        $manager->flush();
    }


    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 3; // TODO: Implement getOrder() method.
    }

}