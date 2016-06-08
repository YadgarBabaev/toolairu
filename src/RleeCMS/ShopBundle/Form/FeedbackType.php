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

class FeedbackType extends AbstractType
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
                    'label' => 'Имя',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add('organization', null,
                array(
                    'label' => 'Организация',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add('contact', null,
                array(
                    'label' => 'Контакты',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add('message', null,
                array(
                    'label' => 'Сообщение',
                    'attr' => array(
                        'class' => 'form-control'
                    )
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
            'data_class' => 'RleeCMS\ShopBundle\Entity\Feedback'
        ));
    }
}
