<?php

namespace RleeCMS\ShopBundle\Form;

use FM\ElfinderBundle\Form\Type\ElFinderType;
use RleeCMS\ShopBundle\Entity\Size;
use RleeCMS\ShopBundle\Form\Type\FileBrowserType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
            ->add('name', TextType::class,
                array(
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Name'
                    ),
                    'translation_domain' => 'messages',
                )
            )
            ->add('contact', TextType::class,
                array(
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Phone'
                    ),
                    'translation_domain' => 'messages',
                )
            )
            ->add('mail', EmailType::class,
                array(
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Email'
                    ),
                    'translation_domain' => 'messages'
                )
            )
            ->add('message', TextareaType::class,
                array(
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'message_text',
                        'cols' => "30", 'rows' => "10"

                    ),
                    'translation_domain' => 'messages'
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
