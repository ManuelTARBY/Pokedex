<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Caught;
use App\Entity\Team;

class HomeController extends AbstractController
{
    
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }
    
    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function index(): Response
    {

        $connection = $this->entityManager->getConnection();

        // Requête pour récupérer le classement des 3 pokemons les plus capturés sur la journée
        $sql = 'SELECT pokemon.name_fr, COUNT(caught.id) AS occurrences
        FROM pokemon
        INNER JOIN caught ON pokemon.id = caught.pokemon_id
        WHERE DATE(caught.date_capture) = CURDATE()
        GROUP BY pokemon.id
        ORDER BY COUNT(caught.id) DESC, pokemon.name_fr
        LIMIT 3';

        $statement = $connection->executeQuery($sql);
        $resultTopShasse = $statement->fetchAllAssociative();

        // Requête pour récupérer le classement des 3 dresseurs ayant capturé le plus de pokemon
        $sql = 'SELECT user.pseudo AS dresseur, COUNT(caught.user_id) AS occurrences
        FROM user
        INNER JOIN caught ON user.id = caught.user_id
        GROUP BY user.id
        ORDER BY COUNT(caught.id) DESC, user.pseudo
        LIMIT 3';


        $statement = $connection->executeQuery($sql);
        $resultTopDresseur = $statement->fetchAllAssociative();

        // Requête pour les shiny du jour
        $lesCaughts = array();
        $dateOfTheDay = date('Y-m-d');
        $dateDuJour = new \DateTime($dateOfTheDay);
        $dateDuJour = $dateDuJour->modify('-5 days');
        
        for ($i = 5 ; $i >= 1 ; $i--){
            $dateDuJourMoins5Jours = $dateDuJour->modify('+1 days');
            $caughts = count($this->entityManager->getRepository(Caught::class)->findBy(['date_capture' => $dateDuJourMoins5Jours]));
            $lesCaughts[] = array(
                "date_capture" => $dateDuJour->format('Y-m-d'),
                "nb_capture" => $caughts,
            );
        }


        // Requête pour les pokemons les plus présents dans les teams
        $sql = 'SELECT COUNT(team_pokemon.pokemon_id) AS occurrences, pokemon.name_fr
        FROM team_pokemon
        JOIN pokemon ON pokemon.id = team_pokemon.pokemon_id
        GROUP BY pokemon.name_fr
        ORDER BY occurrences DESC
        LIMIT 3';

        $statement = $connection->executeQuery($sql);
        $resultTopPokemonInTeam = $statement->fetchAllAssociative();

        foreach ($resultTopPokemonInTeam as $unPoke) {
        $pokemonsShinyTeam[] = array(
            'name_fr' => $unPoke['name_fr'],
            'occurrence' => $unPoke['occurrences'],
        );
        }
        
        return $this->render('home/index.html.twig', [
            'top_shasse' => $resultTopShasse,
            'top_dresseur' => $resultTopDresseur,
            'shiny_du_jour' => $lesCaughts,
            'pokemon_team' => $pokemonsShinyTeam,
        ]);
    }
}
