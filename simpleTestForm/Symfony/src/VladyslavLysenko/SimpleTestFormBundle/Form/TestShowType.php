<?php

namespace VladyslavLysenko\SimpleTestFormBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use VladyslavLysenko\SimpleTestFormBundle\Form\QuestionShowType;
class TestShowType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       
        $builder
            ->add('name','text',array('mapped'=>false))
            ->add('questions', 'collection', array('type' => new QuestionShowType()))
            ->add('send','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'VladyslavLysenko\SimpleTestFormBundle\Entity\Test'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vladyslavlysenko_simpletestformbundle_test';
    }
}
