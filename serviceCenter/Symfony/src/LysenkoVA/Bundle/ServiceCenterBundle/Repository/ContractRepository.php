<?php
/**
 * Created by PhpStorm.
 * User: vladyslav
 * Date: 17.03.15
 * Time: 17:37
 */

namespace LysenkoVA\Bundle\ServiceCenterBundle\Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use LysenkoVA\Bundle\ServiceCenterBundle\Entity\Employee;
use LysenkoVA\Bundle\ServiceCenterBundle\Entity\EntityForQueries;
use Proxies\__CG__\LysenkoVA\Bundle\ServiceCenterBundle\Entity\Department;

class ContractRepository extends EntityRepository{

    public function findByNumber($number){
        $query =  $this->getEntityManager()
            ->createQuery(
                'SELECT c
                  FROM LysenkoVAServiceCenterBundle:Contract c
                  WHERE c.number = :number
                  ');
        $query->setParameter('number',$number);
        if(!$query->getResult())
            return null;
        return  $query->getResult()[0];
    }


    public function findAllContractByEmployee(Employee $employee){
        $query =  $this->getEntityManager()
            ->createQuery(
                'SELECT c
                  FROM LysenkoVAServiceCenterBundle:Contract c
                  WHERE c.master = :employee
                  OR c.manager = :employee');
        $query->setParameter('employee',$employee);
           return  $query->getResult();
    }

    public function findUnmanagedContractByDepartment(\LysenkoVA\Bundle\ServiceCenterBundle\Entity\Department $department){
        $query =  $this->getEntityManager()
            ->createQuery(
                'SELECT c
                  FROM LysenkoVAServiceCenterBundle:Contract c,LysenkoVAServiceCenterBundle:Employee e
                  WHERE e.department = :department
                  AND c.master = e
                  AND  c.manager is NULL
                  ');
        $query->setParameters(
            array(
                'department'=>$department,
            )
        );
        return  $query->getResult();
    }

    public function findCurrentContractByEmployee(Employee $employee){
        $date = new \DateTime();
        $query =  $this->getEntityManager()
            ->createQuery(
                'SELECT contract
                  FROM LysenkoVAServiceCenterBundle:Contract contract
                  WHERE  contract.status !=:status
                  AND (contract.manager = :employee
                  OR  contract.master = :employee)
                  ');
        $query->setParameters(
            array(
                'employee'=>$employee,
                'status' => 'finished'
        ));
        return  $query->getResult();
    }

    public function getSumOfAllContracts(Employee $employee){
        $query =  $this->getEntityManager()
            ->createQuery(
                'SELECT empl.firstName, empl.surname, SUM(contract.sum) AS summ
                  FROM LysenkoVAServiceCenterBundle:Contract contract,
                       LysenkoVAServiceCenterBundle:Employee empl
                  WHERE contract.master = :employee
                  OR contract.manager = :employee
                  GROUP BY empl.firstName, empl.surname
                  ');
        $query->setParameters(
            array(
                'employee'=>$employee,
             ));

        $result = new EntityForQueries();
        if(!$query->getResult())
            $result->sum = 0;
        else
            $result->sum = $query->getResult()[0]['summ'];
        //var_dump($result);
        return $result;
    }

    public function getSumOfEmployeesOfDepartment($department){
       // if($employee=='manager'){
            $query =  $this->getEntityManager()
                ->createQuery(
                    'SELECT empl.firstName, empl.surname, SUM(contract.sum) AS summ
                  FROM LysenkoVAServiceCenterBundle:Contract contract,
                       LysenkoVAServiceCenterBundle:Employee empl
                  WHERE empl = contract.manager
                  AND empl.department = :department
                  GROUP BY empl.firstName, empl.surname
                  ORDER BY summ DESC
                  ');
    //    }
//        else{
//            $query =  $this->getEntityManager()
//                ->createQuery(
//                    'SELECT empl.firstName, empl.surname, SUM(contract.sum) AS summ
//                  FROM LysenkoVAServiceCenterBundle:Contract contract,
//                       LysenkoVAServiceCenterBundle:Employee empl
//                  WHERE empl = contract.master
//                  GROUP BY empl.firstName, empl.surname
//                  ');
//        }
        $query->setParameter('department',$department);

        $result = [];
        $queryResult = $query->getResult();

        foreach($queryResult as $element){
            $obj = new EntityForQueries();
            $obj->sum = $element['summ'];
            $obj->firstName = $element['firstName'];
            $obj->surname = $element['surname'];
            $result[] = ($obj);
        }

        return $result;
    }


}