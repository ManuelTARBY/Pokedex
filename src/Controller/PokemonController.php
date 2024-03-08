<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Pokemon;
use Doctrine\ORM\EntityManagerInterface;

class PokemonController extends AbstractController
{
    #[Route('/pokemon/{pokemon_id}', name: 'app_pokemon')]
    public function index(EntityManagerInterface $entityManager, $pokemon_id): Response
    {
        $connection = $entityManager->getConnection();

        $sql = '
            SELECT pokemon.*, generation.number AS "gene"
            FROM pokemon
            JOIN generation on generation.id = pokemon.generation_id
            WHERE pokedex_id =
        ' . $pokemon_id;

        $statement = $connection->executeQuery($sql);
        $result = $statement->fetchAssociative();

        return $this->render('pokemon/index.html.twig', [
            'pokemon' => $result,
        ]);

        // return $this->render('pokemon/index.html.twig', [
        //     'controller_name' => 'PokemonController',
        // ]);
    }
}
