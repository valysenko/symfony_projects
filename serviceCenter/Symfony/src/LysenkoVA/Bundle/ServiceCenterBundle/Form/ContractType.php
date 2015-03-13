<?php

namespace LysenkoVA\Bundle\ServiceCenterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContractType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number')
            ->add('description')
            ->add('status','choice', array(
                'choices' => array(
                    '1' => 'In progress',
                    '0' => 'Ended'
                )))
            ->add('dateOfEnd')
            ->add('approximatePrice')
            ->add('device', new DeviceType())
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LysenkoVA\Bundle\ServiceCenterBundle\Entity\Contract'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lysenkova_bundle_servicecenterbundle_contract';
    }
}
