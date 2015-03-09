<?php

namespace LysenkoVA\Bundle\ServiceCenterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ActType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('sum')
            ->add('contract')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LysenkoVA\Bundle\ServiceCenterBundle\Entity\Act'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lysenkova_bundle_servicecenterbundle_act';
    }
}
