<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class OrganizationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('users', CollectionType::class, array(
                'label' => 'Users',
                'entry_type' => UserType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'entry_options' => [
                    'attr' => [
                        'placeholder' => "Add",
                    ],
                ],
                'prototype' => true,
                'required' => false
            ))
            ->add('send', SubmitType::class)
        ;
    }
}