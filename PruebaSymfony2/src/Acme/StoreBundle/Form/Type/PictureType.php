<?php

namespace Acme\StoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PictureType extends AbstractType
{
 public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('picFile', 'file', array('required' => true))
            ->add('picTitle', 'text', array('attr' => array('placeholder' => '<img> tag title property')))
            ->add('picAlt', 'text', array('attr' => array('placeholder' => '<img> tag alt property')))
     ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\StoreBundle\Entity\Picture'
        ));
    }

    public function getName()
    {
        return 'picture';
    }
}
?>
