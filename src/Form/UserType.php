<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$roles = [0 => 'ROLE_USER', 1 => 'ROLE_ADMIN', 2=> 'ROLE_SUPER_ADMIN'];
        $roles = ['ROLE_USER' => 0,
            'ROLE_ADMIN' => 1,
            'ROLE_SUPER_ADMIN' => 3
        ];
        $nbr = array('user' => ['ROLE_USER']);
        $builder
            ->add('email', EmailType::class, [
                'label' =>"Email",
                'attr' => [
                    'placeholder' => 'Email',
                    'class' => 'form-control'
                ]
            ])
            ->add('username', TextType::class,[
                'label' => "Nom d'utilisateur",
                'attr' => [
                    'placeholder' => "Nom d'utilisateur",
                    'class' => 'form-control'
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' =>"Mode de passe",
                'attr' => [
                    'placeholder' => 'Mot de passe',
                    'class' => 'form-control'
                ]
            ])
            ->add('confirm_password', PasswordType::class, [
                'label' =>"Comfirmation",
                'attr' => [
                    'placeholder' => 'Confirmer le mot de passe',
                    'class' => 'form-control'
                ]
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'User' => 'ROLE_USER',
                    'Admin' => 'ROLE_ADMIN',
                    'Super' => 'ROLE_SUPER_ADMIN',
                ],
                'mapped'        => false,
                //'multiple'  => true, // choix multiple
                'attr' => [
                    'placeholder' => 'Choisir un rôle',
                    'class' => 'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
