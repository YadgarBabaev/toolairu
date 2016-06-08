<?php

namespace RleeCMS\UserBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrdersType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $translator = $options['translator'];

        $builder
            ->add('email',EmailType::class,array(
                "label" => "Email",
                'horizontal' => false,
            ))
            ->add('fName',TextType::class,array(
                "label" => $translator->trans('Name'),
                'horizontal' => false,
            ))
            ->add('lName',TextType::class,array(
                "label" => $translator->trans('fName'),
                'horizontal' => false,
            ))
            ->add('address',TextType::class,array(
                "label" => $translator->trans('Address'),
                'horizontal' => false,
            ))
            ->add('houseNumber',TextType::class,array(
                "label" => $translator->trans('Apt,suite,etc.'),
                'horizontal' => false,
            ))
            ->add('city',TextType::class,array(
                "label" => $translator->trans('City'),
                'horizontal' => false,
            ))
            ->add('country',TextType::class,array(
                "label" => $translator->trans('Country'),
                'horizontal' => false,
            ))
            ->add('state',TextType::class,array(
                "label" => $translator->trans('State'),
                "required" => false,
                'horizontal' => false,
            ))
            ->add('pIndex',TextType::class,array(
                "label" => $translator->trans('Zip code'),
                'horizontal' => false,
            ))
            ->add('phone',TextType::class,array(
                "label" => $translator->trans('Phone'),
                "required" => true,
                'horizontal' => false,
            ))
            ->add('shippingMethod',EntityType::class,array(
                "label" => false,
                "expanded"=>true,
                "class" =>'RleeCMS\ReferenceBundle\Entity\ShippingMethods',
                "required" => true,
                'horizontal' => false,
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RleeCMS\UserBundle\Entity\Orders',
            'translator' => null
        ));
    }
}
