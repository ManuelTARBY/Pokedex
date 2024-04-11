<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Pokemon;

class PokemonController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/pokemon/{pokemon_id}', name: 'app_pokemon', methods: ['GET'])]
    public function index($pokemon_id): Response
    {
        $connection = $this->entityManager->getConnection();

        $sql = 'SELECT pokemon.name_fr, pokemon.pokedex_id FROM pokemon 
        JOIN pokemon_pokemon ON pokemon.id = pokemon_pokemon.pokemon_source
        WHERE pokemon_pokemon.pokemon_target = (SELECT pokemon.id
        FROM pokemon WHERE pokemon.pokedex_id = ' . $pokemon_id . ')';

        $statement = $connection->executeQuery($sql);
        $resultPrevo = $statement->fetchAllAssociative();

        $pokemon = $this->entityManager->getRepository(Pokemon::class)->findOneBy(['pokedex_id' => $pokemon_id]);

        dump($pokemon);

        return $this->render('pokemon/index.html.twig', [
            'pokemon' => $pokemon,
            'prevolutions' => $resultPrevo,
        ]);
    }
}
