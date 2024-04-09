<?php

namespace App\Command;

use App\Entity\Pokemon;
use App\Entity\Type;
use App\Entity\Ability;
use App\Entity\Generation;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;

#[AsCommand(
    name: 'Import:Pokemon',
    description: 'Add a short description for your command',
)]
class ImportPokemonCommand extends Command
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {   
        $pokeJSON = json_decode(file_get_contents(__DIR__.'/../../pokemon.json')); 
        for ($i = 0; $i < count($pokeJSON); $i++){
            $pokemon = new Pokemon();
            $pokemon->setNameFr($pokeJSON[$i]->name->fr);
            $pokemon->setNameEn($pokeJSON[$i]->name->en);
            $pokemon->setNameJp($pokeJSON[$i]->name->jp);
            $pokemon->setPokedexId($pokeJSON[$i]->pokedex_id);
            $pokemon->setCategory($pokeJSON[$i]->category);
            $pokemon->setHp($pokeJSON[$i]->stats->hp);
            $pokemon->setAtk($pokeJSON[$i]->stats->atk);
            $pokemon->setDef($pokeJSON[$i]->stats->def);
            $pokemon->setSpeAtk($pokeJSON[$i]->stats->spe_atk);
            $pokemon->setSpeDef($pokeJSON[$i]->stats->spe_def);
            $pokemon->setVit($pokeJSON[$i]->stats->vit);
            $pokemon->setHeight($pokeJSON[$i]->height);
            $pokemon->setWeight($pokeJSON[$i]->weight);
            $pokemon->setSpriteRegular($pokeJSON[$i]->sprites->regular);
            if ($pokeJSON[$i]->sprites->shiny != null){
                $pokemon->setSpriteShiny($pokeJSON[$i]->sprites->shiny);
            }else{
                $pokemon->setSpriteShiny("None");
            }

            $typeManager = $this->entityManager->getRepository(Type::class);
            $generationManager =  $this->entityManager->getRepository(Generation::class);
            $abilityManager =  $this->entityManager->getRepository(Ability::class);

            $checkgeneration = $generationManager->findOneBy(['number'=>$pokeJSON[$i]->generation]);
            if ($checkgeneration == null){
                $newgeneration = new Generation();
                $newgeneration->setNumber($pokeJSON[$i]->generation);
                $this->entityManager->persist($newgeneration);
            }else{
                $newgeneration = $checkgeneration;
            }
            $pokemon->setGeneration($newgeneration);

            foreach ($pokeJSON[$i]->talents as $talent){
                $checkAbility = $abilityManager->findOneBy(['name'=>$talent->name]);
                if ($checkAbility == null){
                    $newability = new Ability();
                    $newability->setName($talent->name);
                    $newability->setHidden($talent->tc);
                    $this->entityManager->persist($newability);
                }else{
                    $newability = $checkAbility;
                }
                $pokemon->addPokemonHasAbility($newability);
            }
            
            foreach ($pokeJSON[$i]->types as $type) {
                $checkType = $typeManager->findOneBy(['name'=>$type->name]);
                if ($checkType == null){
                    $newtype = new Type();
                    $newtype->setName($type->name);
                    $newtype->setLogo($type->image);
                    $this->entityManager->persist($newtype);
                }else{
                    $newtype = $checkType;
                }
                $pokemon->addPokemonHasType($newtype);
            }
            $this->entityManager->persist($pokemon);
            $this->entityManager->flush();
        }
        
        $pokeManager = $this->entityManager->getRepository(Pokemon::class);
        for ($i = 0; $i < count($pokeJSON); $i++){
            $pokemon = $pokeManager->findOneBy(['pokedex_id'=>$pokeJSON[$i]->pokedex_id]);
            if ($pokeJSON[$i]->evolution !== null && $pokeJSON[$i]->evolution->next !== null){ 
                foreach ($pokeJSON[$i]->evolution->next as $next){
                    $evolution = $pokeManager->findOneBy(['pokedex_id'=>$next->pokedex_id]);
                    $pokemon->addEvolution($evolution);
                    $this->entityManager->persist($pokemon);
                }
                $this->entityManager->flush();
            }
        }
             
        $io = new SymfonyStyle($input, $output);
        $io->success('Finito Pipo');

        return Command::SUCCESS;
    }
}
