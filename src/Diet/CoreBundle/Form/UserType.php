<?php
namespace Diet\CoreBundle\Form;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\AbstractType;

class UserType extends AbstractType
{
    private $name;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName', 'text');
        $builder->add('lastName', 'text');
        $builder->add('email', 'text');
        $builder->add('birthday', 'birthday');
        $builder->add('height', 'number');
    }

    function __construct($addname)
    {
        $this->name = '_' . $addname;
    }

    public function getName()
    {
        return 'user' . $this->name;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'Diet\CoreBundle\Entity\User'
        ));
    }
}
