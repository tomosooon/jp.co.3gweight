<?php
namespace Diet\CoreBundle\Form;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\AbstractType;

class WeightType extends AbstractType
{
    private $name;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('password', 'password');
        $builder->add('email', 'text');
        //        $builder->add('submit', 'submit');
    }
/*
    function __construct()
    {
        $this->name = '';
    }

    function __construct($addname)
    {
        $this->name = '_' . $addname;
    }
*/
    public function getName()
    {
        return 'weight'/* . $this->name*/;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'Diet\CoreBundle\Entity\Weight'
        ));
    }
}
