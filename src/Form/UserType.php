<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    private $security;

    public function __construct(Security $security){
        $this->security = $security;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email :',
                'attr' => ['class'=>'bg-neutral-800 h-8 w-full border-black rounded-lg color-white text-22 mt-1 px-2', 'maxlenght' => 60],
            ])
            ->add('pseudo', TextType::class, [
                'label' => 'Pseudo :',
                'attr' => ['class'=>'bg-neutral-800 h-8 w-full border-black rounded-lg color-white text-22 mt-1 px-2', 'maxlenght' => 30],
            ]);
            if($this->security->isGranted('ROLE_ADMIN')){
                $builder
                    ->add('roles', ChoiceType::class, [
                        'label' => 'Role :',
                        'expanded' => true,
                        'multiple' => true,
                        'choices' => ['Admin' => 'ROLE_ADMIN'],
                    ]);
            }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
