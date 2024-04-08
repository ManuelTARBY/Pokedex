<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

class ShinydexController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/shinydex', name: 'app_shinydex')]
    public function index(): Response
    {
        $connection = $this->entityManager->getConnection();

        $sql = '
            SELECT pokedex_id, sprite_shiny
            FROM pokemon
            ORDER BY pokedex_id
        ';

        $statement = $connection->executeQuery($sql);
        $resultPoke = $statement->fetchAssociative();

        $sql = '
            SELECT * 
            FROM generation 
            ORDER BY number
        ';

        $statement = $connection->executeQuery($sql);
        $generations = $statement->fetchAllAssociative();

        return $this->render('shinydex/index.html.twig', [
            'pokemons' => $resultPoke,
            'generations' => $generations,
        ]);
    }
}
