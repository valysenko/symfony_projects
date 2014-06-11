<?php
/**
 * Created by PhpStorm.
 * User: vladyslav
 * Date: 28.05.14
 * Time: 13:40
 */

namespace Vladyslav\SmartBookmarkBundle\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Vladyslav\SmartBookmarkBundle\Entity\Bookmark;

class BookmarkType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('name','text')
            ->add('description','text')
            ->add('link','url')
            ->add('category','text',array('mapped'=>false))
            ->add('add','submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vladyslav\SmartBookmarkBundle\Entity\Bookmark',
            'cascade_validation' => true,
        ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'name';
    }

} 