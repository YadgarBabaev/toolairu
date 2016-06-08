<?php

namespace RleeCMS\CMSBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class PagesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullName', null,
                array(
                    'label' => 'Полное название страницы',
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                )
            )
            ->add('alias', null,
                array(
                    'label' => '',
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                )
            )
            ->add('content', CKEditorType::class, array(
                'label' => 'Содержание страницы',
                'attr' =>
                    array(
                        'class' => 'form-control'
                    ),
            ))
            ->add('status', ChoiceType::class, array(
                    'label' => 'Статус',
                    'choices' => array(
                        'Опубликован' => '1',
                        'Не опубликован' => '0',
                    ),
                    'expanded' => true,
                    'multiple' => false,
                    'required' => true,)
            )
            ->add('published', null, array(
                'label' => 'Дата публикации',
                'required' => true,
                'widget' => 'single_text',
                'format' => 'dd.MM.yyyy',
                'attr' =>
                    array(
                        'data-provider' => 'datepicker'
                    ),
            ))
            ->add('hide', ChoiceType::class, array(
                    'label' => 'Отображение',
                    'choices' => array(
                        'Скрыть заголовок страницы' => 'hideTitle',
                        'Скрыть текст страницы' => 'hideText',
                    ),
                    'required' => false,
                    'expanded' => true,
                    'multiple' => true,
                    'mapped' => false)
            )
            ->add('parent', null, array(
                'label' => 'Родительский элемент',
                'attr' =>
                    array(
                        'class' => 'form-control'
                    ),
                'required' => false,
            ))
            ->add('title', null,
                array(
                    'label' => 'Заголовок',
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                    'required' => true,
                )
            )
            ->add('description', null,
                array(
                    'label' => 'Описание страницы',
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                )
            )
            ->add('keywords', null,
                array(
                    'label' => 'Ключевые слова',
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                )
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RleeCMS\CMSBundle\Entity\Pages'
        ));
    }
}
