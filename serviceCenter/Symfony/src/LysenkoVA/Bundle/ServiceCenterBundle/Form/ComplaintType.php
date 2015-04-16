<?php

namespace LysenkoVA\Bundle\ServiceCenterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ComplaintType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('date')
            ->add('text','textarea')
            ->add('Write','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LysenkoVA\Bundle\ServiceCenterBundle\Entity\Complaint'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lysenkova_bundle_servicecenterbundle_complaint';
    }
}
