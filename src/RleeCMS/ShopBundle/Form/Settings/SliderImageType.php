<?php

namespace RleeCMS\ShopBundle\Form\Settings;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class SliderImageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image', FileType::class, array(
                    'label' => 'Изображение',
                    'attr' => array(
                        'class' => 'form-control',

                    ),
                    'required' => $options['flag']
                )
            )
            ->add('name', TextType::class,
                array(
                    'label' => 'Наименование',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add('title', CKEditorType::class,
                array(
                    'label' => 'Заголовок',
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
                    'required' => true,
                )
            )
            ->add('orderning', IntegerType::class,
                array(
                    'label' => 'Порядковый номер',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add('type', ChoiceType::class, array(
                    'label' => 'Тип',
                    'choices' => array(
                        'Товар' => 'product',
                        'Категория' => 'category'
                    ),
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                    'required' => true,
                )
            )
            ->add('product', EntityType::class, array(
                    'label' => 'Товар',
                    'class' => 'RleeCMSShopBundle:Product',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('c');
                    },
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                    'required' => false,
                )
            )
            ->add('category', EntityType::class, array(
                    'label' => 'Категория',
                    'class' => 'RleeCMSShopBundle:Category',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('c')
                            ->orderBy('c.root');
                    },
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
                    'required' => false,
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
            'data_class' => 'RleeCMS\ShopBundle\Entity\SliderImage',
            'flag' => true,
        ));
    }
}
