<?php

namespace Vladyslav\SmartBookmarkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class IndexController extends Controller{
    public function indexAction(Request $request){
        return $this->render('VladyslavSmartBookmarkBundle:Index:index.html.twig');
    }
}
