<?php

namespace RleeCMS\ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ColorType extends AbstractType
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
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RleeCMS\ShopBundle\Entity\Color',
            'flag' => true,
            'label_render' => false,
        ));
    }
}
