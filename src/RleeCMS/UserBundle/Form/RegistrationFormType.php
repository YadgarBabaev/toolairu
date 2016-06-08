<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RleeCMS\UserBundle\Form;

use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label' => 'Name',
                'horizontal' => false,
            ))
            ->add('fName', null, array(
                'label' => 'fName',
                'horizontal' => false,
            ))
            ->add('gender', ChoiceType::class, array(
                'label' => 'gender',
                'choices'  => array(
                    'female' => '1',
                    'male' => '2',
                ),
                'expanded'=>true,
                'multiple'=>false,
                'label' => 'lName',
                'horizontal' => false,
            ))
            ->add('email', EmailType::class, array(
                'label' => 'form.email',
                'horizontal' => false,
                'translation_domain' => 'FOSUserBundle'
            ))
            ->add('news', null, array(
                'label' => 'Subscribe to news',
//                'choice_label'=>false,
                'horizontal' => false,
            ))
            ->add('plainPassword', RepeatedType::class, array(
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
            ));
        $builder->remove('username');
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'rleecms_user_registration';
    }
}
