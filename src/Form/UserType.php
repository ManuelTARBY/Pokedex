<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => ['class'=>'bg-neutral-800 h-8 w-11/12 border-black rounded-lg color-white text-22 mt-1 px-2'],
            ])
            ->add('pseudo', TextType::class, [
                'attr' => ['class'=>'bg-neutral-800 h-8 w-11/12 border-black rounded-lg color-white text-22 mt-1 px-2'],
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un mot de passe',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'invalid_message' => 'Les champs mot de passe doivent contenir des mots de passe identiques.',
                'options' => ['attr' => ['class'=>'bg-neutral-800 h-8 w-11/12 border-black rounded-lg color-white text-22 mt-1 px-2']],
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe :', 'label_attr' => ['class'=>"text-white pl-2 text-26"]],
                'second_options' => ['label' => 'Confirmer mot de passe :', 'label_attr' => ['class'=>"text-white pl-2 text-26"]],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
