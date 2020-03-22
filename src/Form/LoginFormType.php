<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options ) {
        //parent::buildForm( $builder, $options ); 

        $builder
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'loginForm__inputField',
                    'placeholder' => 'E-mail'
            ]])

            ->add('password', PasswordType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'loginForm__inputField',
                    'placeholder' => 'Пароль'
            ]])

            ->add('sand', SubmitType::class, [
                'label' => 'Войти',
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
