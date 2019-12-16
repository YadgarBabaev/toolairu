<?php

namespace XpatBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SimpleRefType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,array(
                'label' => 'Наименование ru'
            ))
            ->add('status',ChoiceType::class,array(
                'label' => 'Статус',
                'choices' => array(
                    'Активный' => '1',
                    'Неактивный' => '0',
                ),
                'expanded' => true,
                'multiple' => false,
                'required' => true,)
            )
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'XpatBundle\Entity\SimpleRef'
        ));
    }
}
