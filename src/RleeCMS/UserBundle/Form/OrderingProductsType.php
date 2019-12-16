<?php

namespace RleeCMS\UserBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderingProductsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product',EntityType::class,array(
                'label' => 'Продукт',
                'class' => 'RleeCMS\ShopBundle\Entity\Product'
            ))
            ->add('color',EntityType::class,array(
                'label' => 'Цвет',
                'class' => 'RleeCMS\ShopBundle\Entity\Color'
            ))
            ->add('size',EntityType::class,array(
                'label' => 'Размер',
                'class' => 'RleeCMS\ShopBundle\Entity\Size'
            ))
            ->add('count',NumberType::class,array(
                'label' => 'Количество'
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RleeCMS\UserBundle\Entity\OrderingProducts'
        ));
    }
}
