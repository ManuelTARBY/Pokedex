<?php

namespace App\Command;

use App\Entity\Team;
use App\Entity\Pokemon;
use App\Entity\User;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;

#[AsCommand(
    name: 'Add:Team',
    description: 'Add a short description for your command',
)]
class AddTeamCommand extends Command
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
            ->addArgument('pseudonym', InputArgument::REQUIRED, "Pseudonyme de l'utilisateur à qui ajouter une team")
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $pokeManager = $this->entityManager->getRepository(Pokemon::class);
        $userManager = $this->entityManager->getRepository(User::class);
        $pseudo = $input->getArgument('pseudonym');
        $user = $userManager->findOneBy(['pseudo'=>$pseudo]);
        if ($user != null){
            $pokedex_ids = [];
            for ($i = 0; $i < 6; $i++){
                $pokedex_ids[] = random_int(1,1025);
            }
            $team = new Team();
            $team->setName("Team".array_sum($pokedex_ids));
            $team->setUser($user);
            foreach ($pokedex_ids as $pokedex_id){
                $pokemon = $pokeManager->findOneby(['pokedex_id'=>$pokedex_id]);
                $team->addPokemonAsTeam($pokemon);
                $this->entityManager->persist($team);
            }        
            
            $this->entityManager->flush();
            $io = new SymfonyStyle($input, $output);
            $io->success('Great Success');

            return Command::SUCCESS;
        }else{
            $io = new SymfonyStyle($input, $output);
            $io->caution('No user with that pseudonym');
            return Command::FAILURE;
        }
    }
}
