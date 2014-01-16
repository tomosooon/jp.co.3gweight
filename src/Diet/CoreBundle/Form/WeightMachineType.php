<?php
namespace Diet\CoreBundle\Form;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\AbstractType;

class WeightMachineType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('machineid', 'text');
        //        $builder->add('submit', 'submit');
    }

    public function getName()
    {
        return 'weightMachine';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'Diet\CoreBundle\Entity\WeightMachine'
        ));
    }
}
