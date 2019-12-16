<?php

namespace RleeCMS\ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Mopa\Bundle\BootstrapBundle\Form\Type\TabType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Doctrine\ORM\EntityRepository;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class CategoryType extends AbstractType
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
                    'attr' => array(
                        'class' => 'form-control'
                    ),

                )
            )
            ->add('b2b', ChoiceType::class,
                array(
                    'label' => 'Раздел B2B',
                    'choices' => array(
                        'Pronto' => 'pronto',
                        'Pret-a-porter' => 'pret-a-porter',
                        'Stock' => 'stock',
                    ),
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                    'required' => false,
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
            );

        $other
            ->add('parent', EntityType::class, array(
                    'label' => 'Родительский элемент',
                    'class' => 'RleeCMSShopBundle:Category',
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
            ->add('sale', CheckboxType::class, array(
                    'label' => 'В продаже',
                    'required' => false,
                )
            )
            ->add('orderning', IntegerType::class,
                array(
                    'label' => 'Порядковый номер',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                ))
            ->add('image', FileType::class, array(
                'label' => 'Изображение',
                'attr' => array(
                    'class' => 'form-control'
                ),
                'required' => false
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
            'data_class' => 'RleeCMS\ShopBundle\Entity\Category',
            'flag' => true,
        ));
    }
}
