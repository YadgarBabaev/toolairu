<?php

namespace RleeCMS\ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SizeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('size', null,
                array(
                    'label' => 'Размер',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add('marking', null,
                array(
                    'label' => 'Маркировка',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add('height', null,
                array(
                    'label' => 'Рост (в см)',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add('bust', null,
                array(
                    'label' => 'Бюст',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add('waist', null,
                array(
                    'label' => 'Талия',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add('hips', null,
                array(
                    'label' => 'Бедра',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add('front_waist_length', null,
                array(
                    'label' => 'Передняя длина талии',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add('bust_depth', null,
                array(
                    'label' => 'Глубина бюста',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add('back_length', null,
                array(
                    'label' => 'Длина спины',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add('back_width', null,
                array(
                    'label' => 'Ширина спины',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add('shoulder_width', null,
                array(
                    'label' => 'Ширина плеч',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add('hand_length', null,
                array(
                    'label' => 'Длина рук',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RleeCMS\ShopBundle\Entity\Size'
        ));
    }
}
