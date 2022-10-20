<?php

namespace App\Form\Auth;

use App\Entity\Auth\User;
use Njeaner\Symfrop\Form\SymfropBaseType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends SymfropBaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->setBuilder($builder);

        $this
            // ->add('pseudo')
            // ->add('roles')
            // ->add('password')
            ->add('username')
            ->add('address')
            ->add('phoneNumber')
            // ->add('image')
            // ->add('createdAt')
            // ->add('updatedAt')
            // ->add('isLocked')
            // ->add('lockedAt')
            // ->add('admin')
            ->add('parrain')
            // ->add('role')
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
