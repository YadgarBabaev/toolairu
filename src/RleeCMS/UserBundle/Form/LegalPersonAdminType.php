<?php

namespace RleeCMS\UserBundle\Form;

use RleeCMS\UserBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LegalPersonAdminType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var User $user */
        $user = $options['user'];

        $builder
            ->add('email',TextType::class,array(
                'label' => "email",
                'horizontal' => false,
                'data' => $user->getEmail()
            ));
            if($user->getId()){
            $builder->add('changePassword',CheckboxType::class,array(
                'label' => 'Изменить пароль',
                'mapped' => false,
                'required' => false,
                'horizontal' => false,
            ));
            }
             $builder  ->add('plain_password', RepeatedType::class, array(
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
            ->add('roles',ChoiceType::class,array(
                'label' => 'Роли',
                'choices' => array(
                    'Администратор' => 'ROLE_SUPER_ADMIN'
                ),
                'horizontal' => false,
                'required' => false,
                'expanded' => true,
                'multiple' => true,
            ))
            ->add('news', CheckboxType::class, array(
                'label' => 'Подписка на новости',
                'horizontal' => false,
                'required' => false,
                'data' => $user->getNews()
//                'choice_label'=>false,
            ))

            ->add('companyName',TextType::class,array(
                'label' => "Наименование компании",
                'required' => true,
                'horizontal' => false,
            ))
            ->add('companyType',TextType::class,array(
                'label' => "Вид предприятия",
                'required' => false,
                'horizontal' => false,
            ))
            ->add('position',TextType::class,array(
                'label' => "Должность(директор,менеджер,владелец)",
                'required' => false,
                'horizontal' => false,
            ))
            ->add('fio',TextType::class,array(
                'label' => "ФИО",
                'required' => true,
                'horizontal' => false,
            ))
            ->add('inn',TextType::class,array(
                'label' => "Налоговый регистрационный номер предприятия ИНН",
                'required' => false,
                'horizontal' => false,
            ))
            ->add('directorFio',TextType::class,array(
                'label' => "ФИО Исполнительного директора",
                'required' => false,
                'horizontal' => false,
            ))
            ->add('country',TextType::class,array(
                'label' => "Страна",
                'required' => false,
                'horizontal' => false,
            ))
            ->add('pIndex',TextType::class,array(
                'label' => "Почтовый индекс",
                'required' => false,
                'horizontal' => false,
            ))
            ->add('city',TextType::class,array(
                'label' => "Город/Поселок",
                'required' => false,
                'horizontal' => false,
            ))
            ->add('street',TextType::class,array(
                'label' => "Улица",
                'required' => false,
                'horizontal' => false,
            ))
            ->add('houseNumber',TextType::class,array(
                'label' => "Номер дома",
                'required' => false,
                'horizontal' => false,
            ))
            ->add('requisite1',TextType::class,array(
                'label' => "1-й Банк",
                'required' => false,
                'horizontal' => false,
            ))
            ->add('requisite2',TextType::class,array(
                'label' => "2-й Банк",
                'required' => false,
                'horizontal' => false,
            ))
            ->add('factCountry',TextType::class,array(
                'label' => "Страна",
                'required' => false,
                'horizontal' => false,
            ))
            ->add('factPIndex',TextType::class,array(
                'label' => "Почтовый индекс",
                'required' => false,
                'horizontal' => false,
            ))
            ->add('factCity',TextType::class,array(
                'label' => "Город поселок",
                'required' => false,
                'horizontal' => false,
            ))
            ->add('factStreet',TextType::class,array(
                'label' => "Улица",
                'required' => false,
                'horizontal' => false,
            ))
            ->add('factHouseNumber',TextType::class,array(
                'label' => "Номер дома",
                'required' => false,
                'horizontal' => false,
            ))
            ->add('phoneNumber',TextType::class,array(
                'label' => "Телефон",
                'required' => false,
                'horizontal' => false,
            ))
            ->add('mobileNumber',TextType::class,array(
                'label' => "Мобильный телефон",
                'required' => false,
                'horizontal' => false,
            ))
            ->add('whatsApp',TextType::class,array(
                'label' => "WhatsApp,Vyber",
                'required' => false,
                'horizontal' => false,
            ))
            ->add('email1',TextType::class,array(
                'label' => "Электронная почта 2",
                'required' => false,
                'horizontal' => false,
            ))
            ->add('email2',TextType::class,array(
                'label' => "Электронная почта 2",
                'required' => false,
                'horizontal' => false,
            ))
            ->add('site',TextType::class,array(
                'label' => "Веб страница",
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
            'user' => null
        ));
    }
}
