<?php

namespace VladyslavLysenko\SimpleTestFormBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QuestionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description','textarea')

            ->add('quantityOfAnswers')
            ->add('mark')
            ->add('type','choice', array(
                'choices' => array(
                    'radio' => 'radio',
                    'checkbox' => 'checkbox'
                )))
            ->add('test')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'VladyslavLysenko\SimpleTestFormBundle\Entity\Question'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vladyslavlysenko_simpletestformbundle_question';
    }
}
