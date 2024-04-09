<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Pokemon;
use App\Entity\Generation;
use App\Entity\User;

class ShinydexController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }
    
    #[Route('/shinydex', name: 'app_shinydex')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $pokemonManager = $this->entityManager->getRepository(Pokemon::class);

        $pokemons = $pokemonManager->findAll();

        $generationManager = $this->entityManager->getRepository(Generation::class);

        $generations = $generationManager->findAll();

        $storage = [];
        $user = $this->getUser();

        $caughts = $user->getCaught();

        foreach ($caughts as $caught) {
            $pokemon = $caught->getPokemon();
            $storage[] = $pokemon;
        }

        $capturedPokemons = [];
        foreach ($storage as $capturedPokemon) {
            $capturedPokemons[$capturedPokemon->getId()] = true;
        }

        dump($capturedPokemons);

        return $this->render('shinydex/index.html.twig', [
            'pokemons' => $pokemons,
            'generations' => $generations,
            'capturedPokemons' => $capturedPokemons,
        ]);
    }
}