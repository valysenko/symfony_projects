<?php
/**
 * Created by PhpStorm.
 * User: vladyslav
 * Date: 18.03.15
 * Time: 9:25
 */

namespace LysenkoVA\Bundle\ServiceCenterBundle\Repository;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use LysenkoVA\Bundle\ServiceCenterBundle\Entity\Department;
use LysenkoVA\Bundle\ServiceCenterBundle\Entity\MadeService;
use LysenkoVA\Bundle\ServiceCenterBundle\Entity\Service;

class EmployeeRepository  extends EntityRepository{
    public function findMastersFromDepartment(Department $department){
        $roles = new ArrayCollection();
        $roles->add('ROLE_MASTER');

        $query =  $this->getEntityManager()

            ->createQuery(
                'SELECT e
                  FROM LysenkoVAServiceCenterBundle:Employee e
                  WHERE e.department =:department
                  AND e.roles =:role
                ');

        $query->setParameters(
            array(
                'department'=>$department,
                'role'=>'ROLE_MASTER'
        ));


        return  $query->getResult();
    }

    public function findManagersFromDepartment(Department $department){
        $roles = new ArrayCollection();
        $roles->add('ROLE_MASTER');

        $query =  $this->getEntityManager()
            ->createQuery(
                'SELECT e
                  FROM LysenkoVAServiceCenterBundle:Employee e
                  WHERE e.department =:department
                  AND e.roles =:role
                ');

        $query->setParameters(
            array(
                'department'=>$department,
                'role'=>'ROLE_MANAGER'
            ));
        return  $query->getResult();
    }

    public function getEmployeeByServiceAndDepartment(Department $department, Service $madeService ){
        $query =  $this->getEntityManager()
            ->createQuery(
                'SELECT empl
                  FROM LysenkoVAServiceCenterBundle:Employee empl,
                       LysenkoVAServiceCenterBundle:Contract contr,
                       LysenkoVAServiceCenterBundle:MadeService mS,
                  WHERE empl = contr.master
                   AND mS.contract=contr
                   AND empl.department = :department
                   AND mS NOT IN ( SELECT madeS
                                    FROM LysenkoVAServiceCenterBundle:MadeService madeS
                                    WHERE madeS = :name)
                  GROUP BY empl
                ');

        $query->setParameters(
            array(
                'department'=>$department,
                'name'=>$madeService->getName()
            ));
        return  $query->getResult();

    }
}