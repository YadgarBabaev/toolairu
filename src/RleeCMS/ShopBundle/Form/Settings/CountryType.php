<?php

namespace RleeCMS\ShopBundle\Form\Settings;

use Symfony\Component\Form\AbstractType;
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

class CountryType extends AbstractType
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
            ->add('procent', NumberType::class,
                array(
                    'label' => 'Процент',
                    'attr' =>
                        array(
                            'class' => 'form-control'
                        ),
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
            ->add('parent', EntityType::class, array(
                    'label' => 'Родительский элемент',
                    'class' => 'RleeCMSShopBundle:Country',
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
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RleeCMS\ShopBundle\Entity\Country'
        ));
    }
}
