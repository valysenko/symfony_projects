<?php
/**
 * Created by PhpStorm.
 * User: vladyslav
 * Date: 18.04.15
 * Time: 15:21
 */

namespace LysenkoVA\Bundle\ServiceCenterBundle\Repository;


use Doctrine\ORM\EntityRepository;
use LysenkoVA\Bundle\ServiceCenterBundle\Entity\Department;
use LysenkoVA\Bundle\ServiceCenterBundle\Entity\Employee;

class ClientRepository extends EntityRepository {

    public function getClientsOfManagerMoreThanTwoServices(Employee $manager){
        $query =  $this->getEntityManager()
            ->createQuery(
                'SELECT client
                  FROM LysenkoVAServiceCenterBundle:Client client,
                       LysenkoVAServiceCenterBundle:Device device,
                       LysenkoVAServiceCenterBundle:Contract contract,
                       LysenkoVAServiceCenterBundle:Employee employee,
                       LysenkoVAServiceCenterBundle:MadeService mS
                  WHERE employee = :manager
                  AND device.client = client
                  AND contract.manager = employee
                  AND contract.device = device
                  AND mS.contract = contract
                  GROUP BY client
                  HAVING COUNT(mS) > 2
                ');

        $query->setParameter(
                'manager', $manager
            );


        return  $query->getResult();
    }

}