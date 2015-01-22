<?php

namespace VladyslavLysenko\SimpleTestFormBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VariantType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $data = $options['data'];
        $id = $data->getQuestion()->getTest()->getId();

        $builder
            ->add('description','textarea')
            ->add('quantityOfPoints')
            ->add('question', 'entity', array(
                'class' => 'VladyslavLysenko\SimpleTestFormBundle\Entity\Question',
                'query_builder' => function(EntityRepository $er ) use ( $id ) {
                    return $er->createQueryBuilder('w')
                        ->where('w.test = ?1')
                        ->setParameter('1',$id);

    },
            ));}
    
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
