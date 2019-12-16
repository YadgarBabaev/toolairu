<?php

namespace RleeCMS\ShopBundle\Form\Settings;

use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Mopa\Bundle\BootstrapBundle\Form\Type\TabType;
use Doctrine\ORM\EntityRepository;

class CurrencyType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $main = $builder->create('mainTab', TabType::class, array(
            'label' => 'Главное',
            'inherit_data' => true,
        ));
        $other = $builder->create('otherTab', TabType::class, array(
            'label' => 'Склонение',
            'inherit_data' => true,
        ));

        $main
            ->add('isoName', null,
                array(
                    'label' => 'Международный код',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add('name', null,
                array(
                    'label' => 'Наименование',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add('symbol', null,
                array(
                    'label' => 'Символ',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                    'required'=>false
                )
            )
            ->add('shortSign', null,
                array(
                    'label' => 'Короткое обозначение',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                    'required'=>false
                )
            )
            ->add('status', ChoiceType::class, array(
                    'label' => 'Статус',
                    'choices' => array(
                        'Опубликован' => '1',
                        'Не опубликован' => '0',
                    ),
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                    'expanded' => true,
                    'multiple' => false,
                    'required' => true,
                )
            )
            ->add('rate', null,
                array(
                    'label' => 'Курс',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add('main', CheckboxType::class, array(
                    'label' => 'Основная валюта',
                    'required' => false,
                )
            )
            ->add('rate_for_main', null, array(
                    'label' => 'Курс к новой основной валюте',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                    'required' => false,
                    'mapped' => false
                )
            );
        $other
            ->add('morph1', null,
                array(
                    'label' => 'Один',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add('morph2', null,
                array(
                    'label' => 'Два',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add('morph5', null,
                array(
                    'label' => 'Пять',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add('subunitMorph1', null,
                array(
                    'label' => 'Один (десятичная часть)',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                    'required'=>false
                )
            )
            ->add('subunitMorph2', null,
                array(
                    'label' => 'Два (десятичная часть)',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                    'required'=>false
                )
            )
            ->add('subunitMorph5', null,
                array(
                    'label' => 'Пять (десятичная часть)',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                    'required'=>false
                )
            );
        $builder
            ->add($main)
            ->add($other);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RleeCMS\ShopBundle\Entity\Currency'
        ));
    }
}
