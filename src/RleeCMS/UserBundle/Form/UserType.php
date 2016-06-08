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
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['data'];

        $builder
            ->add('name', null, array(
                'label' => 'Name',
            ))
            ->add('fName', null, array(
                'label' => 'fName',
            ))
            ->add('gender', ChoiceType::class, array(
                'label' => 'Пол',
                'choices'  => array(
                    'Женский' => '1',
                    'Мужской' => '2',
                ),
                'expanded'=>true,
                'multiple'=>false,
            ))
            ->add('email', EmailType::class, array(
                'label' => 'form.email',
                'translation_domain' => 'FOSUserBundle'
            ))
            ->add('news', null, array(
                'label' => 'Подписка на новости',
//                'choice_label'=>false,
            ));
            if($user->getId()!=null){
                $builder->add('changePassword',CheckboxType::class,array(
                    'label' => 'Изменить пароль',
                    'mapped' => false,
                    'required' => false
                ));
            }
            $builder
                ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array(
                    'label' => 'form.password',
                ),
                'second_options' => array(
                    'label' => 'form.password_confirmation',
                ),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
            ->add("enabled",CheckboxType::class,array(
                'label' => 'Активный',
                 'required' => false
            ));
        $builder->remove('username');
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RleeCMS\UserBundle\Entity\User'
        ));
    }
}
