<?php

namespace RleeCMS\ShopBundle\Form;

use FM\ElfinderBundle\Form\Type\ElFinderType;
use RleeCMS\ShopBundle\Entity\Size;
use RleeCMS\ShopBundle\Form\Type\FileBrowserType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Mopa\Bundle\BootstrapBundle\Form\Type\TabType;
use Doctrine\ORM\EntityRepository;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $main = $builder->create('main', TabType::class, array(
            'label' => 'Главное',
            'inherit_data' => true,
        ));
        $other = $builder->create('other', TabType::class, array(
            'label' => 'Остальное',
            'inherit_data' => true,
        ));

        $main
            ->add('name', null,
                array(
                    'label' => 'Наименование',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add('alias', null,
                array(
                    'label' => 'Альяс',
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                )
            )
            ->add('description', CKEditorType::class,
                array(
                    'label' => 'Описание',
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                    'required' => false,
                )
            )
            ->add('note', TextareaType::class,
                array(
                    'label' => 'Примечание',
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                    'required' => false,
                )
            )
            ->add('metaTagTitle', null,
                array(
                    'label' => 'Заголовки (мета-тэги)',
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                )
            )
            ->add('metaTagDescription', TextareaType::class,
                array(
                    'label' => 'Описания (мета-тэги)',
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                    'required' => false,
                )
            )
            ->add('metaTagKeywords', TextareaType::class,
                array(
                    'label' => 'Ключевые слова (мета-тэги)',
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                    'required' => false,
                )
            )
            ->add('tags', null,
                array(
                    'label' => 'Мета-тэги',
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                    'required' => false,
                ))
            ->add('category', EntityType::class, array(
                'label' => 'Основная категория',
                'class' => 'RleeCMSShopBundle:Category',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c');
                },
                'attr' =>
                    array(
                        'class' => 'form-control',
                        'style' => 'width: 100%'
                    ),
            ))
            ->add('categories', EntityType::class, array(
                'label' => 'Дополнительные категории',
                'class' => 'RleeCMSShopBundle:Category',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c');
                },
                'attr' =>
                    array(
                        'class' => 'form-control',
                        'style' => 'width: 100%'
                    ),
                'multiple' => true,
                'required' => false
            ))
            ->add('b2b', CheckboxType::class, array(
                'label' => 'B2B Товар',
                'data' => false,
                'mapped'=>false,
                'required' => false,
                'attr' => array(
                    'onchange'=>'b2b(this)'
                )

            ))
            ->add('categoryB2B', EntityType::class, array(
                'label' => 'B2B Категория',
                'class' => 'RleeCMSShopBundle:Category',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')->where('c.b2b is not NULL');
                },
                'attr' =>
                    array(
                        'class' => 'form-control',
                        'style' => 'width: 100%;'
                    ),
                'required' => false
            ))
            ->add('filters', EntityType::class, array(
                'label' => 'Фильтры',
                'class' => 'RleeCMSShopBundle:Filters',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c');
                },
                'attr' =>
                    array(
                        'class' => 'form-control',
                        'style' => 'width: 100%'
                    ),
                'multiple' => true,
                'required' => false
            ));
        $other
            ->add('composition', null,
                array(
                    'label' => 'Материал',
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                    'required' => false,

                )
            )
            ->add('style', null,
                array(
                    'label' => 'Стиль',
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                    'required' => false,

                )
            )
            ->add('type', null,
                array(
                    'label' => 'Тип/Описание',
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                    'required' => false,

                )
            )
            ->add('price', NumberType::class,
                array(
                    'label' => 'Цена',
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                    'required' => false,

                )
            )
            ->add('priceDiscount', NumberType::class,
                array(
                    'label' => 'Цена со скидкой (Акция)',
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                    'required' => false,

                )
            )
            ->add('priceB2B', NumberType::class,
                array(
                    'label' => 'Оптовая Цена',
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                    'required' => false,
                )
            )
            ->add('orderning', IntegerType::class,
                array(
                    'label' => 'Порядковый номер',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                    'required' => false,

                ))
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
            ))
            ->add('sizes', EntityType::class, array(
                'label' => 'Размеры',
                'class' => 'RleeCMSShopBundle:Size',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c');
                },
                'attr' =>
                    array(
                        'class' => 'form-control',
                        'style' => 'width: 100%'
                    ),
                'multiple' => true,
                'required' => false
            ))
            ->add('colors', CollectionType::class, array(
                'label' => 'Цвета',
                'entry_type' => ColorType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'widget_add_btn' => array(
                    'label' => "",
                    'icon' => 'plus-circle',
                ),
                'widget_remove_btn' => array(
                    'label' => "",
                    'icon' => 'trash-o'
                ),

                'required' => false
            ))
            ->add('image', FileType::class, array(
                'label' => 'Изображение',
                'attr' => array(
                    'class' => 'form-control'
                ),
                'required' => $options['flag']
            ))
            ->add('images', FileBrowserType::class, array(
                'label' => 'Фото',

                'allow_add' => true,
                'widget_add_btn' => array(
                    'class' => 'btn btn-default'
                ),
                'allow_delete' => true,
                'prototype' => true,
            ));
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
            'data_class' => 'RleeCMS\ShopBundle\Entity\Product',
            'flag' => true,
        ));
    }
}
