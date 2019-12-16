<?php

namespace RleeCMS\ReferenceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShippingMethodsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,array(
                'label' => 'Наименование'
            ))
            ->add('coast',NumberType::class,array(
                'label' => 'Стоимость доставки',
                'required' => false
            ))
            ->add('type',ChoiceType::class,array(
                'label' => 'Стоимость доставки',
                'required' => true,
                'choices' => array(
                    'B2C' => '1',
                    'B2B' => '2'
                ),

            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RleeCMS\ReferenceBundle\Entity\ShippingMethods'
        ));
    }
}
