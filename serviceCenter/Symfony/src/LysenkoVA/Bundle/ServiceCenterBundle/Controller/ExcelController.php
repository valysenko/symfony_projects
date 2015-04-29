<?php
/**
 * Created by PhpStorm.
 * User: vladyslav
 * Date: 16.04.15
 * Time: 14:46
 */

namespace LysenkoVA\Bundle\ServiceCenterBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ExcelController extends Controller{

    /**
     * @Route("/services", name="excel_services")
     * @Template()
     */
    public function servicesAction(){

        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('LysenkoVAServiceCenterBundle:Category')->findAll();

        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

        $phpExcelObject->getProperties()->setCreator("liuggio")
            ->setLastModifiedBy("Giulio De Donato")
            ->setTitle("Office 2005 XLSX Test Document")
            ->setSubject("Office 2005 XLSX Test Document")
            ->setDescription("Test document for Office 2005 XLSX, generated using PHP classes.")
            ->setKeywords("office 2005 openxml php")
            ->setCategory("Test result file");

        $phpExcelObject->getActiveSheet()->getColumnDimensionByColumn('A')->setAutoSize(true);
        $phpExcelObject->getActiveSheet()->getColumnDimensionByColumn('B')->setAutoSize(true);

        $index = 1;
            foreach($categories as $category){
                $phpExcelObject->setActiveSheetIndex(0)
                    ->setCellValue("A$index", $category->getName());
                $phpExcelObject->getActiveSheet()->getStyle("A$index")->getFont()->setBold(true);

                $index++;
                foreach($category->getServices() as $service) {

                    $phpExcelObject->setActiveSheetIndex(0)
                        ->setCellValue("A$index", $service->getName())
                        ->setCellValue("B$index", $service->getPrice());
                    $index++;
                }
            }


        $phpExcelObject->getActiveSheet()->setTitle('Services');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment;filename=services.xls');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');

        return $response;

    }

    /**
     * @Route("/admin/bestmanagers/{id}", name="excel_best_managers")
     * @Template()
     */
    public function bestManagersExcelAction($id){

        $em = $this->getDoctrine()->getManager();

        $em = $this->getDoctrine()->getManager();
        $department = $em->getRepository('LysenkoVAServiceCenterBundle:Department')
            ->findOneById($id);

        $result = $em->getRepository('LysenkoVAServiceCenterBundle:Contract')
            ->getSumOfEmployeesOfDepartment($department);

        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

        $phpExcelObject->getProperties()->setCreator("liuggio")
            ->setLastModifiedBy("Giulio De Donato")
            ->setTitle("Office 2005 XLSX Test Document")
            ->setSubject("Office 2005 XLSX Test Document")
            ->setDescription("Test document for Office 2005 XLSX, generated using PHP classes.")
            ->setKeywords("office 2005 openxml php")
            ->setCategory("Test result file");

        $phpExcelObject->getActiveSheet()->getColumnDimensionByColumn('A')->setAutoSize(true);
        $phpExcelObject->getActiveSheet()->getColumnDimensionByColumn('B')->setAutoSize(true);
        $phpExcelObject->getActiveSheet()->getColumnDimensionByColumn('C')->setAutoSize(true);

        $phpExcelObject->setActiveSheetIndex(0)
            ->setCellValue("A1", 'Sum')
            ->setCellValue("B1", 'Name')
            ->setCellValue("C1", 'Surname');

        $phpExcelObject->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
        $phpExcelObject->getActiveSheet()->getStyle("B1")->getFont()->setBold(true);
        $phpExcelObject->getActiveSheet()->getStyle("C1")->getFont()->setBold(true);

        $index = 2;
        foreach($result as $item){
            $phpExcelObject->setActiveSheetIndex(0)
                ->setCellValue("A$index", $item->sum)
                ->setCellValue("B$index", $item->firstName)
                    ->setCellValue("C$index", $item->surname);
            $index++;
        }

        $phpExcelObject->getActiveSheet()->setTitle('Services');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment;filename=best_managers.xls');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');

        return $response;

    }

}