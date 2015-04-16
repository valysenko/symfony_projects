<?php

namespace LysenkoVA\Bundle\ServiceCenterBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Date;

class ContractType extends AbstractType
{
    private $choices;

    public function __construct($choices)
    {
        $this->choices = $choices;
    }


    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $id=4;
       // var_dump($options['choices']);
        $year = date("Y");
        $builder
            ->add('number')
            ->add('description')
//            ->add('master')
            ->add('master','entity', array(
                'class' => 'LysenkoVA\Bundle\ServiceCenterBundle\Entity\Employee',
//                'query_builder' => function(EntityRepository $er ) use ( $id ) {
//                    return $er->createQueryBuilder('w')
//                        ->where('w.id > ?1')
//                        ->setParameter('1',$id);
                'choices' => $this->choices
                ))
            ->add('dateOfEnd', 'date',array(
                'input'  => 'datetime',
                'widget' => 'choice',
                'years' =>range($year,$year+5),
            ))
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
