<?php

namespace VladyslavLysenko\SimpleTestFormBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VariantShowType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
                $formFactory = $builder->getFormFactory();
        $builder
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($formFactory) {
            $form = $event->getForm();
            $data = $event->getData();
            $question = $data->getQuestion();
//            var_dump($data);

            $type = $question->getType();
            if($type ==='radio')
                $form->add('description','choice',array('label'=>'sad'));
//                ->add('public', 'checkbox', array(
//                    'label'     => 'Show this entry publicly?',
//                    'required'  => false,
//                    'mapped' =>false,
//                ));;

        });

        ;


//        $builder
//            ->add('description')
//        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'VladyslavLysenko\SimpleTestFormBundle\Entity\Variant'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vladyslavlysenko_simpletestformbundle_variant';
    }
}
