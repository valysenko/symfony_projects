<?php
/**
 * Created by PhpStorm.
 * User: vladyslav
 * Date: 09.03.15
 * Time: 12:31
 */

namespace LysenkoVA\Bundle\ServiceCenterBundle\Controller;
use LysenkoVA\Bundle\ServiceCenterBundle\Entity\Employee;
use LysenkoVA\Bundle\ServiceCenterBundle\Entity\Role;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;


class IndexController extends Controller{
    /**
     * @Route("/", name="index")
     * @Template()
     */
    public function indexAction(){



        return array();
    }
}