<?php

namespace RleeCMS\ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class ShopByLookType extends AbstractType
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
            ->add('image', FileType::class, array(
                    'label' => 'Изображение',
                    'attr' => array(
                        'class' => 'form-control',

                    ),
                    'required' => $options['flag']
                )
            )
            ->add('products', EntityType::class, array(
                'label' => 'Товары',
                'class' => 'RleeCMSShopBundle:Product',
                'query_builder' => function (EntityRepository $er) use ($options) {
                    return $er->createQueryBuilder('p')
                            ->where('p.category = :cId')
                            ->setParameter('cId', $options['cId']);
                },
                'attr' =>
                    array(
                        'class' => 'form-control',
                        'style' => 'width: 100%'
                    ),
                'multiple' => true,
                'required' => false
            ))
            ->add('orderning', IntegerType::class,
                array(
                    'label' => 'Порядковый номер',
                    'attr' => array(
                        'class' => 'form-control'
                    )
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

        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RleeCMS\ShopBundle\Entity\ShopByLook',
            'flag' => true,
            'cId' => null,
        ));
    }
}
