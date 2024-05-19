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

        // Récupère nom fr, id de pokedex et image regular du pokemon
        $sql = 'SELECT pokemon.name_fr, pokemon.pokedex_id, pokemon.sprite_regular FROM pokemon 
        JOIN pokemon_pokemon ON pokemon.id = pokemon_pokemon.pokemon_source
        WHERE pokemon_pokemon.pokemon_target = (SELECT pokemon.id
        FROM pokemon WHERE pokemon.pokedex_id = ' . $pokemon_id . ')';

        $statement = $connection->executeQuery($sql);
        $resultPrevo = $statement->fetchAllAssociative();

        // Récupère l'objet pokemon
        $pokemon = $this->entityManager->getRepository(Pokemon::class)->findOneBy(['pokedex_id' => $pokemon_id]);
        
        // Récupère le nom du type
        $Id = $pokemon->getId();
        $sql = 'SELECT t.name FROM type t
        JOIN type_pokemon tp ON t.id = tp.type_id
        WHERE tp.pokemon_id =' .$Id;

        $statement = $connection->executeQuery($sql);
        $poketypes = $statement->fetchOne();

        return $this->render('pokemon/index.html.twig', [
            'pokemon' => $pokemon,
            'prevolutions' => $resultPrevo,
            'pokeTypes' => $poketypes,
        ]);
    }
}
