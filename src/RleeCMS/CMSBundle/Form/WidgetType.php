<?php

namespace RleeCMS\CMSBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class WidgetType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null,
                array(
                    'label' => 'Заголовок',
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                )
            )
            ->add('hideTitle', ChoiceType::class, array(
                    'label' => 'Скрыть заголовок',
                    'choices' => array(
                        'Нет' => 1,
                        'Да' => 0,
                    ),
                    'expanded' => true,
                    'multiple' => false,
                    'required' => true,
                )
            )
            ->add('type', ChoiceType::class, array(
                    'label' => 'Тип виджета',
                    'choices' => array(
                        'HTML' => 'html',
                        'Меню' => 'menu',
                        'Слайдер' => 'slider',
                        'Коллекция' => 'category',
                        'Товар' => 'product'
                    ),
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                    'required' => true,
                )
            )
            ->add('hideMenu', EntityType::class, array(
                    'label' => 'Тип меню',
                    'class' => 'AdminCMSBundle:MenuType',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('t')
                            ->where('t.status = 1');
                    },
                    'required' => false,
                    'mapped' => false,
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                )
            )
            ->add('hideSliderCount', IntegerType::class,
                array(
                    'label' => 'Количество изображений',
                    'attr' =>
                        array(
                            'class' => 'form-control',
                            'min' => 0
                        ),
                    'mapped' => false,
                    'required' => false,
                )
            )
            ->add('hideSliderSpeed', IntegerType::class,
                array(
                    'label' => 'Скорость ротации (в миллисекундах)',
                    'attr' =>
                        array(
                            'class' => 'form-control',
                            'min' => 0
                        ),
                    'mapped' => false,
                    'required' => false,
                )
            )
            ->add('hideSliderTitle', ChoiceType::class, array(
                    'label' => 'Скрыть заголовок изображения',
                    'choices' => array(
                        'Нет' => 1,
                        'Да' => 0,
                    ),
                    'multiple' => false,
                    'required' => false,
                    'mapped' => false,
                )
            )
            ->add('hideSliderHref', ChoiceType::class, array(
                    'label' => 'Скрыть ссылку слайдера',
                    'choices' => array(
                        'Нет' => 1,
                        'Да' => 0,
                    ),
                    'multiple' => false,
                    'required' => false,
                    'mapped' => false,
                )
            )
            ->add('hideCategory', EntityType::class, array(
                    'label' => 'Каталог',
                    'class' => 'RleeCMSShopBundle:Category',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('t')
                            ->where('t.status = 1');
                    },
                    'required' => false,
                    'mapped' => false,
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                )
            )
            ->add('hideCategoryHref', ChoiceType::class, array(
                    'label' => 'Скрыть ссылку каталога',
                    'choices' => array(
                        'Нет' => 1,
                        'Да' => 0,
                    ),
                    'multiple' => false,
                    'required' => false,
                    'mapped' => false,
                )
            )
            ->add('hideProduct', EntityType::class, array(
                    'label' => 'Товар',
                    'class' => 'RleeCMSShopBundle:Product',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('t')
                            ->where('t.status = 1');
                    },
                    'required' => false,
                    'mapped' => false,
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                )
            )
            ->add('hideProductHref', ChoiceType::class, array(
                    'label' => 'Скрыть ссылку товара',
                    'choices' => array(
                        'Нет' => 1,
                        'Да' => 0,
                    ),
                    'multiple' => false,
                    'required' => false,
                    'mapped' => false,
                )
            )
            ->add('titleHtml', CKEditorType::class, array(
                    'label' => 'Содержание заголовка',
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                    'required' => false,
                )
            )
            ->add('html', CKEditorType::class, array(
                    'label' => 'Содержание виджета',
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                    'required' => false,
                )
            )
            ->add('position', ChoiceType::class, array(
                    'label' => 'Позиция',
                    'choices' => array(
                        'Главное меню' => 'mainMenu',
                        'Нижнее меню' => 'footerMenu',
                        'Левое меню только метиалы' => 'left_menu',
                        'right_menu' => 'right_menu',
                        'Карусель' => 'carousel',
                        'pink' => 'pink',
                        'Коллекция/Товар (левый верхний блок)' => 'category_left_1',
                        'Коллекция/Товар (левый нижний блок)' => 'category_left_2',
                        'Коллекция/Товар (правый блок)' => 'category_right',
                    ),
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                    'required' => true,
                )
            )
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
            ->add('orderning', null,
                array(
                    'label' => 'Порядковый номер',
                    'attr' =>
                        array(
                            'class' => 'col-xs-10 col-sm-5'
                        ),
                    'required' => false,
                )
            )
            ->add('menus', null, array(
                'label' => 'Пункты меню',
                'attr' =>
                    array(
                        'class' => 'col-xs-10 col-sm-5'
                    ),
                'required' => false,
            ))
            ->add('menuCheck', ChoiceType::class, array(
                    'label' => 'Отображение в меню',
                    'choices' => array(
                        'Во всех пунктах меню' => 'all',
                        'На указанных пунктах меню' => 'in_menu',
                        'Во всех пунктах меню, кроме указанных' => 'not_menu',
                        'На главной странице' => 'main',
                        'Во всех пунктах меню, кроме главной' => 'not_main',
                    ),
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                    'required' => true,
                )
            )
            ->add('class', null,
                array(
                    'label' => 'Класс',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            );

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RleeCMS\CMSBundle\Entity\Widget'
        ));
    }
}
