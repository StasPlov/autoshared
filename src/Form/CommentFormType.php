<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options ) {
        //parent::buildForm( $builder, $options ); 

        $builder
            ->add('content', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'addCommentForm__textfield', 
                    'placeholder' => 'Введите текст комментария.'
                ]])

            ->add('sand', SubmitType::class, [
                'label' => 'Добавить комментарий',
                'attr' => [
                    'class' => 'addCommentForm__submitButton'
                ]]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Comment::class
        ]);
    }
}
