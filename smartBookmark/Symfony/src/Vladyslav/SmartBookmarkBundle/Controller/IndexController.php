<?php

namespace Vladyslav\SmartBookmarkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class IndexController extends Controller{
    public function slashAction(Request $request){
        return $this->redirect($this->generateUrl('index_page'));
    }
    public function indexAction(Request $request, $_locale){
        return $this->render('VladyslavSmartBookmarkBundle:Index:index.html.twig');
    }
}
