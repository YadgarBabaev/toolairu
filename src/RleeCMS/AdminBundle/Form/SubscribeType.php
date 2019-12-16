<?php

namespace RleeCMS\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SubscribeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null,
                array(
                    'label' => 'Наименование',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add('type', ChoiceType::class, array(
                    'label' => 'Тип',
                    'choices' => array(
                        'B2B' => 'b2b',
                        'B2C' => 'b2c',
                    ),
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                    'required' => true,
                )
            )
            ->add('title', null,
                array(
                    'label' => 'Тема',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add('content', CKEditorType::class,
                array(
                    'label' => 'Описание',
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                    'required' => false,
                )
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RleeCMS\AdminBundle\Entity\Subscribe'
        ));
    }
}
