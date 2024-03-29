<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

class PokedexController extends AbstractController
{
    
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }
    
    #[Route('/pokedex', name: 'app_pokedex')]
    public function index(): Response
    {

        $connection = $this->entityManager->getConnection();

        $sql = '
            SELECT pokemon.id, pokemon.pokedex_id, pokemon.name_fr, pokemon.generation_id, GROUP_CONCAT(type.logo) AS logos
            FROM type_pokemon
            JOIN pokemon ON pokemon.id = type_pokemon.pokemon_id
            JOIN type ON type.id = type_pokemon.type_id
            GROUP BY pokemon_id, pokemon.pokedex_id, pokemon.name_fr, pokemon.generation_id
        ';

        $statement = $connection->executeQuery($sql);
        $pokemons = $statement->fetchAllAssociative();

        $sql = '
        SELECT * FROM type ORDER BY name
        ';

        $statement = $connection->executeQuery($sql);
        $types = $statement->fetchAllAssociative();

        $sql = '
        SELECT * FROM type_pokemon
        ';

        $statement = $connection->executeQuery($sql);
        $poketypes = $statement->fetchAllAssociative();

        $sql = '
        SELECT * FROM generation ORDER BY number
        ';

        $statement = $connection->executeQuery($sql);
        $generations = $statement->fetchAllAssociative();

        return $this->render('pokedex/index.html.twig', [
            'pokemons' => $pokemons,
            'types' => $types,
            'poketypes' => $poketypes,
            'generations' => $generations,
        ]);
    }
}
