<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Pokemon;
use App\Entity\Generation;

class ShinydexController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }
    
    #[Route('/shinydex', name: 'app_shinydex')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if ($user != null){ 
            $pokemons = $this->entityManager->getRepository(Pokemon::class)->findAll();
    
            $generations = $this->entityManager->getRepository(Generation::class)->findAll();
    
            $storage = [];
    
            $caughts = $user->getCaught();
            
            // Récupération du nombre de pokemons capturés par génération
            $totalCaughtByGen = [];
            // $uniquePokemon = [];
            foreach ($caughts as $caught) {
                $pokemon = $caught->getPokemon();
                $storage[] = $pokemon;
                // if (!in_array($caught->getPokemon()->getPokedexId(), $uniquePokemon)) {
                    // $uniquePokemon[] = $caught->getPokemon()->getPokedexId();
                    if (array_key_exists($caught->getPokemon()->getGeneration()->getId(), $totalCaughtByGen)){
                        $totalCaughtByGen [$caught->getPokemon()->getGeneration()->getId()]++;
                    }else{
                        $totalCaughtByGen [$caught->getPokemon()->getGeneration()->getId()]=1;
                    }
                // }
            }
    
            $capturedPokemons = [];
            
            foreach ($storage as $capturedPokemon) {
                $capturedPokemons[$capturedPokemon->getId()] = true;
            }
            

            // Récupération du nombre total de pokemons capturés
            // $uniqueCaughts = [];
            // $uniqueIds = [];

            // foreach ($caughts as $caught) {
            //     if (!in_array($caught->getPokemon()->getPokedexId(), $uniqueIds)) {
            //         $uniqueIds[] = $caught->getPokemon()->getPokedexId();
            //         $uniqueCaughts[] = $caught;
            //     }
            // }

            // $totalCaught = count($uniqueCaughts);
            $totalCaught = count($caughts);
    
            $total = count($pokemons);
    
            $totalByGen = [];
            foreach ($pokemons as $pokemon) {
                $tot = $pokemon->getId();
                $storage[] = $tot;
                if (array_key_exists($pokemon->getGeneration()->getId(), $totalByGen)){
                    $totalByGen [$pokemon->getGeneration()->getId()]++;
                }else{
                    $totalByGen [$pokemon->getGeneration()->getId()]=1;
                }
            }
    
            return $this->render('shinydex/index.html.twig', [
                'pokemons' => $pokemons,
                'generations' => $generations,
                'capturedPokemons' => $capturedPokemons,
                'totalCaught' => $totalCaught,
                'totalCaughtByGen' => json_encode($totalCaughtByGen),
                'total' => $total,
                'totalByGen' => json_encode($totalByGen),
            ]);
        }else{
            return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
        }

    }
}