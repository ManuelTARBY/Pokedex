<?php

namespace App\Form;

use App\Entity\Pokemon;
use App\Entity\Team;
use App\Entity\User;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {   
        $team = $options["data"];
        $pokemons = [];
        foreach($team->getPokemonAsTeam() as $pokemon){
            $pokemons[] = $pokemon;
        }
        $builder
            ->add('name')
            ->add('Pokemon_1', EntityType::class, [
                'class' => Pokemon::class,
                'choice_label' => 'name_fr',
                'mapped' => false,
                'data' => isset($pokemons[0]) ? $pokemons[0] : null,
            ])
            ->add('Pokemon_2', EntityType::class, [
                'class' => Pokemon::class,
                'choice_label' => 'name_fr',
                'mapped' => false,
                'data' => isset($pokemons[1]) ? $pokemons[1] : null,
            ])
            ->add('Pokemon_3', EntityType::class, [
                'class' => Pokemon::class,
                'choice_label' => 'name_fr',
                'mapped' => false,
                'data' => isset($pokemons[2]) ? $pokemons[2] : null,
            ])
            ->add('Pokemon_4', EntityType::class, [
                'class' => Pokemon::class,
                'choice_label' => 'name_fr',
                'mapped' => false,
                'data' => isset($pokemons[3]) ? $pokemons[3] : null,
            ])
            ->add('Pokemon_5', EntityType::class, [
                'class' => Pokemon::class,
                'choice_label' => 'name_fr',
                'mapped' => false,
                'data' => isset($pokemons[4]) ? $pokemons[4] : null,
            ])
            ->add('Pokemon_6', EntityType::class, [
                'class' => Pokemon::class,
                'choice_label' => 'name_fr',
                'mapped' => false,
                'data' => isset($pokemons[5]) ? $pokemons[5] : null,
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
        ]);
    }
}
