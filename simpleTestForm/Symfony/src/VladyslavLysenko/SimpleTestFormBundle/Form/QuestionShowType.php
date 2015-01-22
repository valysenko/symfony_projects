<?php

namespace VladyslavLysenko\SimpleTestFormBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use VladyslavLysenko\SimpleTestFormBundle\Form\VariantShowType;

class QuestionShowType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $formFactory = $builder->getFormFactory();
        $builder->add('description','hidden')
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($formFactory) {
                $form = $event->getForm();
                $data = $event->getData();

                //$question = $data->getQuestion();
                $variants = $data->getVariants();

                $type = $data->getType();
                $variants_to_form = array();
//                if ($type === 'checkbox')
//                    var_dump($variants);
//                foreach ($variants as $variant) {
//
//                    $variants_to_form[$variant->getQuantityOfPoints()] = $variant->getDescription();
//                    var_dump($variants_to_form);
//                }
//                $i = 0;
//                foreach ($variants as $variant) {
//
//                    $variants_to_form[$i] = $variant->getDescription();
//                    $i++;
//                }

                foreach ($variants as $variant) {
                    $variants_to_form[$variant->getDescription()] = $variant->getDescription();
                }

                if ($type === 'radio') {
                    $form->add('variants', 'choice',
                        array('choices' => $variants_to_form,
                            'mapped' => false,
                        ));
                }
                if ($type === 'checkbox') {

                    $form->add('variants', 'choice',
                        array('choices' => $variants_to_form,
                            'mapped' => false,
                            'multiple' => true));
                }


            });;
//        $builder->add('description')->add('variants');
//            ->add('variants', 'collection', array('type' => new VariantShowType()));

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
