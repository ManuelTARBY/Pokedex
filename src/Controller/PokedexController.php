<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

class PokedexController extends AbstractController
{
    #[Route('/pokedex', name: 'app_pokedex')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $connection = $entityManager->getConnection();

        $sql = '
            SELECT pokemon.pokedex_id, pokemon.name_fr, GROUP_CONCAT(type.logo) AS logos
            FROM type_pokemon
            JOIN pokemon ON pokemon.id = type_pokemon.pokemon_id
            JOIN type ON type.id = type_pokemon.type_id
            GROUP BY pokemon.pokedex_id, pokemon.name_fr
        ';

        $statement = $connection->executeQuery($sql);
        $results = $statement->fetchAllAssociative();

        return $this->render('pokedex/index.html.twig', [
            'results' => $results,
        ]);
    }
}
