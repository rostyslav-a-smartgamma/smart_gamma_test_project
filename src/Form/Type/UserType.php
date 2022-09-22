<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('role', ChoiceType::class, array(
                'choices' => [
                    'ADMIN' => 'ADMIN',
                    'SALES' => 'SALES',
                    'CEO' => 'CEO',
                    'CTO' => 'CTO',
                ],
                'multiple' => true,
                'expanded' => true
            ))
            ->add('password', TextType::class)
        ;
    }
}