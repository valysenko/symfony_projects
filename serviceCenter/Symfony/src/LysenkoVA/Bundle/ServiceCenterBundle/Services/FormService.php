<?php
/**
 * Created by PhpStorm.
 * User: vladyslav
 * Date: 11.03.15
 * Time: 16:58
 */

namespace LysenkoVA\Bundle\ServiceCenterBundle\Services;

use Symfony\Component\Form\FormFactoryInterface;

class FormService {
    protected $formFactory;
    protected $router;

    public function __construct(FormFactoryInterface $formFactory, $router)
    {
        $this->formFactory = $formFactory;
        $this->router = $router;
    }
}