<?php

namespace VladyslavLysenko\SimpleTestFormBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('VladyslavLysenkoSimpleTestFormBundle:Default:index.html.twig', array('name' => $name));
    }
}
