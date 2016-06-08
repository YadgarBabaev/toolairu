<?php

namespace RleeCMS\CMSBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class MenuType extends AbstractType
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
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add('type', ChoiceType::class, array(
                    'label' => 'Вид меню',
                    'choices' => array(
                        'Обычная страница' => 'content',
                        'Якорь' => 'anchor',
                        'Блог (новости, статьи)' => 'blog',
                        'URL' => 'url',
                        'Магазин' => 'shop',
                        'Коллекция' => 'collection',
                        'Для Бизнеса' => 'b2b',
                        'Shop By Look' => 'shop_by_look',
                        'Обратная связь' => 'feedback'
                    ),
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                    'required' => true,
                )
            )
            ->add('page', null, array(
                'label' => 'Страница',
                'attr' => array(
                    'class' => 'form-control'
                ),
                'required' => false,
            ))
            ->add('url', null, array(
                'label' => 'URL',
                'attr' => array(
                    'class' => 'form-control'
                ),
                'required' => false,
            ))
            ->add('parent', null, array(
                'label' => 'Родительский элемент',
                'attr' => array(
                    'class' => 'form-control'
                ),
                'required' => false,
            ))
            ->add('menuType', EntityType::class, array(
                    'label' => 'Тип меню',
                    'class' => 'AdminCMSBundle:MenuType',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('t')
                            ->where('t.status = 1');
                    },
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
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
                    'required' => true,)
            )
            ->add('orderning', null,
                array(
                    'label' => 'Порядковый номер',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )->add('params', CollectionType::class, array(
                'allow_add' => true,

            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RleeCMS\CMSBundle\Entity\Menu'
        ));
    }
}
