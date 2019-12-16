<?php

namespace RleeCMS\ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RefundType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userName', TextType::class,array(
                'label' => 'Имя'
            ))
            ->add('clientNumber', TextType::class,array(
                'label' => 'Номер клиента'
            ))
            ->add('orderNumber', TextType::class,array(
                'label' => 'Номер заказа'
            ))
            ->add('orderDate',DateTimeType::class,array(
                'widget' => 'single_text',
                'label' => 'Дата заказа',
                'attr' => array(
                    'class' => 'date'
                )
            ))
            ->add('shippingDate',DateTimeType::class,array(
                'widget' => 'single_text',
                'label' => 'Дата получения заказа',
                'attr' => array(
                    'class' => 'date'
                )
            ))
            ->add('description', TextareaType::class,array(
                'label' => 'Описание'
            ))
            ->add('reqvisit', TextType::class,array(
                'label' => 'Банковский счет(для возврата денег)'
            ))
            ->add('address', TextType::class,array(
                'label' => 'Адрес'
            ))
            ->add('postAdress', TextType::class,array(
                'label' => 'Почтовый адрес'
            ))
            ->add('email')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RleeCMS\ShopBundle\Entity\Refund'
        ));
    }
}
