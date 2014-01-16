<?php
namespace Diet\CoreBundle\Form;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\AbstractType;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title','text');
        $builder->add('body','textarea');
        $builder->add('submit','submit');

    }

    public function getName()
    {
        return 'post';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'Diet\CoreBundle\Entity\Post'));
    }
}