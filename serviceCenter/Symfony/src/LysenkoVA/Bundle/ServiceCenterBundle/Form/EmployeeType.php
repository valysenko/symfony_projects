<?php

namespace LysenkoVA\Bundle\ServiceCenterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmployeeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('roles','choice', array(
                'multiple' => true,
                         'choices' => array('ROLE_MANAGER' => 'manager', 'ROLE_MASTER' => 'master'),
                ))
            ->add('firstName')
            ->add('surname')
            ->add('username')
            ->add('telephoneNumber')
            ->add('department')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LysenkoVA\Bundle\ServiceCenterBundle\Entity\Employee'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lysenkova_bundle_servicecenterbundle_employee';
    }
}
