<?php
namespace Diet\CoreBundle\Form;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\AbstractType;

class AdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text');
        $builder->add('password', 'password');
        $builder->add('email', 'text');
        $builder->add('adminRoles', 'entity', array(
                'class' => 'DietCoreBundle:Role',
                'property' => 'name',
                'multiple' => true,
                'expanded' => true,
        ));
        $builder->add('submit', 'submit');
    }

    public function getName()
    {
        return 'admin';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'Diet\CoreBundle\Entity\Admin'
        ));
    }
}
