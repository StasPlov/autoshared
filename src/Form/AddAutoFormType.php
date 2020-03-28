<?php

namespace App\Form;

use App\Entity\CatalogAuto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddAutoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options ) {
        //parent::buildForm( $builder, $options ); 

        $builder
            ->add('mark', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'addAutoForm__textfield', 
                    'placeholder' => 'Марка авто'
                ]])

            ->add('model', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'addAutoForm__textfield', 
                    'placeholder' => 'модель авто'
                ]])

            ->add('steering', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'addAutoForm__textfield', 
                    'placeholder' => 'Расположение руля'
                ]])

            
            ->add('engine', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'addAutoForm__textfield', 
                    'placeholder' => 'Объем двигателя'
                ]])

            ->add('power', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'addAutoForm__textfield', 
                    'placeholder' => 'Мощьность'
                ]])

            ->add('transmission', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'addAutoForm__textfield', 
                    'placeholder' => 'Трансмиссия'
                ]])

            ->add('drive', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'addAutoForm__textfield', 
                    'placeholder' => 'Привод'
                ]])

            ->add('color', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'addAutoForm__textfield', 
                    'placeholder' => 'Цвет'
                ]])
                    
            ->add('mileage', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'addAutoForm__textfield', 
                    'placeholder' => 'Пробег'
                ]])

            ->add('bodynumber', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'addAutoForm__textfield', 
                    'placeholder' => 'Номер кузова'
                ]])

            ->add('description', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'addAutoForm__textfield', 
                    'placeholder' => 'Описание'
                ]])
                
            ->add('file', FileType::class, [
                'label' => 'Загрузить фото',

                // Означает, что это поле не связано ни с одним свойством сущности, к которой мы привязали форму (CatalogAuto),
                // так как у нас есть отдельная таблица для файлов
                'mapped' => false,

                'label_attr' => [
                    'class' => 'addAutoForm__loadImgButton'
                ],
                'attr' => [
                    'style' => 'display: none',
                    'class' => false,
                    'placeholder' => 'Описание'
                ]])

            ->add('sand', SubmitType::class, [
                'label' => 'Опубликовать',
                'attr' => [
                    'class' => 'addAutoForm__submitButton'
            ]]);
            
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => CatalogAuto::class
        ]);
    }
}
