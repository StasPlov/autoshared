<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options ) {
        //parent::buildForm( $builder, $options ); 

        $builder
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'registerForm__inputField',
                    'placeholder' => 'E-mail'
            ]])

            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => false,
                    'attr' => [
                        'class' => 'registerForm__inputField',
                        'placeholder' => 'Пароль'
                    ]
                ],
                'second_options' => [
                    'label' => false,
                    'attr' => [
                        'class' => 'registerForm__inputField',
                        'placeholder' => 'Повтор пароля'
                    ]
                ]
            ])

            ->add('sand', SubmitType::class, [
                'label' => 'Зарегистрироваться',
                'attr' => [
                    'class' => 'loginForm__submitButton'
                ]]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}
