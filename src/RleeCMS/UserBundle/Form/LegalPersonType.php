<?php

namespace RleeCMS\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LegalPersonType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $translator = $options['translator'];
        $builder
            ->add('email',TextType::class,array(
                'label' => "email",
                'horizontal' => false,
            ))
                ->add('plain_password', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'options' => array('translation_domain' => 'FOSUserBundle'),
                    'first_options' => array(
                        'label' => 'form.password',
                        'horizontal' => false,
                    ),
                    'second_options' => array(
                        'label' => 'form.password_confirmation',
                        'horizontal' => false,
                    ),
                    'invalid_message' => 'fos_user.password.mismatch',
                ))
            ->add('news', CheckboxType::class, array(
                'label' => $translator->trans('Subscribe to news'),
//                'choice_label'=>false,
            ))

            ->add('companyName',TextType::class,array(
                'label' => $translator->trans('Company name'),
                'required' => true,
                'horizontal' => false,
            ))
            ->add('companyType',TextType::class,array(
                'label' => $translator->trans('Type of enterprise'),
                'required' => false,
                'horizontal' => false,
            ))
            ->add('position',TextType::class,array(
                'label' => $translator->trans('Position(director, manager, owner)'),
                'required' => false,
                'horizontal' => false,
            ))
            ->add('fio',TextType::class,array(
                'label' => $translator->trans('Full name'),
                'required' => true,
                'horizontal' => false,
            ))
            ->add('inn',TextType::class,array(
                'label' => $translator->trans('Tax registration number'),
                'required' => false,
                'horizontal' => false,
            ))
            ->add('directorFio',TextType::class,array(
                'label' => $translator->trans('Director executive name'),
                'required' => false,
                'horizontal' => false,
            ))
            ->add('country',TextType::class,array(
                'label' => $translator->trans('Country'),
                'required' => false,
                'horizontal' => false,
            ))
            ->add('pIndex',TextType::class,array(
                'label' => $translator->trans('Zip code'),
                'required' => false,
                'horizontal' => false,
            ))
            ->add('city',TextType::class,array(
                'label' => $translator->trans('City/Town'),
                'required' => false,
                'horizontal' => false,
            ))
            ->add('street',TextType::class,array(
                'label' => $translator->trans('Street'),
                'required' => false,
                'horizontal' => false,
            ))
            ->add('houseNumber',TextType::class,array(
                'label' => $translator->trans('House number'),
                'required' => false,
                'horizontal' => false,
            ))
            ->add('requisite1',TextType::class,array(
                'label' => $translator->trans('1st Bank'),
                'required' => false,
                'horizontal' => false,
            ))
            ->add('requisite2',TextType::class,array(
                'label' => $translator->trans('2nd Bank'),
                'required' => false,
                'horizontal' => false,
            ))
            ->add('factCountry',TextType::class,array(
                'label' => $translator->trans('Country'),
                'required' => false,
                'horizontal' => false,
            ))
            ->add('factPIndex',TextType::class,array(
                'label' => $translator->trans('Zip code'),
                'required' => false,
                'horizontal' => false,
            ))
            ->add('factCity',TextType::class,array(
                'label' => $translator->trans('City/Town'),
                'required' => false,
                'horizontal' => false,
            ))
            ->add('factStreet',TextType::class,array(
                'label' => $translator->trans('Street'),
                'required' => false,
                'horizontal' => false,
            ))
            ->add('factHouseNumber',TextType::class,array(
                'label' => $translator->trans('House number'),
                'required' => false,
                'horizontal' => false,
            ))
            ->add('phoneNumber',TextType::class,array(
                'label' => $translator->trans('Phone'),
                'required' => false,
                'horizontal' => false,
            ))
            ->add('mobileNumber',TextType::class,array(
                'label' => $translator->trans('Mobile phone'),
                'required' => false,
                'horizontal' => false,
            ))
            ->add('whatsApp',TextType::class,array(
                'label' => "WhatsApp,Vyber",
                'required' => false,
                'horizontal' => false,
            ))
            ->add('email1',TextType::class,array(
                'label' => $translator->trans('Email 1'),
                'required' => false,
                'horizontal' => false,
            ))
            ->add('email2',TextType::class,array(
                'label' => $translator->trans('Email 2'),
                'required' => false,
                'horizontal' => false,
            ))
            ->add('site',TextType::class,array(
                'label' => $translator->trans('WebPage'),
                'required' => false,
                'horizontal' => false,
            ))
        ;
        $builder->remove('username');
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RleeCMS\UserBundle\Entity\LegalPerson',
            'translator' => null
        ));
    }
}
