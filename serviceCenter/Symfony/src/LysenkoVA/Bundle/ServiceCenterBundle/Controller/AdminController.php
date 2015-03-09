<?php
/**
 * Created by PhpStorm.
 * User: vladyslav
 * Date: 09.03.15
 * Time: 13:30
 */

namespace LysenkoVA\Bundle\ServiceCenterBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\BrowserKit\Response;

class AdminController extends Controller{

   /**
     * @Route("/admin", name="cabinet")
    * @Template()
     */
    public function adminAction()
    {
        return array();
    }

}