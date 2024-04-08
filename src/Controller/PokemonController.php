<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

class PokemonController extends AbstractController
{
    #[Route('/pokemon/{pokemon_id}', name: 'app_pokemon', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager, $pokemon_id): Response
    {
        $connection = $entityManager->getConnection();

        $sql = 'SELECT pokemon.*, generation.number AS "gene", type.logo AS "logo"
        FROM pokemon
        JOIN generation ON generation.id = pokemon.generation_id
        JOIN type_pokemon ON pokemon.id = type_pokemon.pokemon_id
        JOIN type ON type.id = type_pokemon.type_id
        WHERE pokedex_id =
        ' . $pokemon_id;

        $statement = $connection->executeQuery($sql);
        $resultPoke = $statement->fetchAssociative();

        $sql = 'SELECT type.logo
        FROM type
        JOIN type_pokemon ON type_pokemon.type_id = type.id
        JOIN pokemon ON pokemon.id = type_pokemon.pokemon_id
        WHERE pokemon.pokedex_id = 
        ' . $pokemon_id;

        $statement = $connection->executeQuery($sql);
        $resultTypes = $statement->fetchAllAssociative();

        $sql = 'SELECT pokemon.name_fr, pokemon.pokedex_id FROM pokemon 
        JOIN pokemon_pokemon ON pokemon.id = pokemon_pokemon.pokemon_target
        WHERE pokemon_pokemon.pokemon_source = (SELECT pokemon.id 
        FROM pokemon WHERE pokemon.pokedex_id = ' . $pokemon_id . ')';

        $statement = $connection->executeQuery($sql);
        $resultEvo = $statement->fetchAllAssociative();

        $sql = 'SELECT pokemon.name_fr, pokemon.pokedex_id FROM pokemon 
        JOIN pokemon_pokemon ON pokemon.id = pokemon_pokemon.pokemon_source
        WHERE pokemon_pokemon.pokemon_target = (SELECT pokemon.id
        FROM pokemon WHERE pokemon.pokedex_id = ' . $pokemon_id . ')';

        $statement = $connection->executeQuery($sql);
        $resultPrevo = $statement->fetchAllAssociative();

        return $this->render('pokemon/index.html.twig', [
            'pokemon' => $resultPoke,
            'types' => $resultTypes,
            'evolutions' => $resultEvo,
            'prevolutions' => $resultPrevo,
        ]);
    }
}
