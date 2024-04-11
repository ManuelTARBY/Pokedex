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
        $pokemons = $this->entityManager->getRepository(Pokemon::class)->findAll();

        $generations = $this->entityManager->getRepository(Generation::class)->findAll();

        $storage = [];
        $user = $this->getUser();

        $caughts = $user->getCaught();
        
        $totalCaughtByGen = [];
        
        foreach ($caughts as $caught) {
            $pokemon = $caught->getPokemon();
            $storage[] = $pokemon;
            if (array_key_exists($caught->getPokemon()->getGeneration()->getId(), $totalCaughtByGen)){
                $totalCaughtByGen [$caught->getPokemon()->getGeneration()->getId()]++;
            }else{
                $totalCaughtByGen [$caught->getPokemon()->getGeneration()->getId()]=1;
            }
        }

        $capturedPokemons = [];
        
        foreach ($storage as $capturedPokemon) {
            $capturedPokemons[$capturedPokemon->getId()] = true;
        }

        $totalCaught = count($caughts);

        $total = count($pokemons);

        dump($totalCaughtByGen);

        return $this->render('shinydex/index.html.twig', [
            'pokemons' => $pokemons,
            'generations' => $generations,
            'capturedPokemons' => $capturedPokemons,
            'totalCaught' => $totalCaught,
            'totalCaughtByGen' => json_encode($totalCaughtByGen),
            'total' => $total,
        ]);
    }
}