<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Entity\Pokemon;
use App\Entity\Team;
use App\Entity\Generation;
use App\Entity\Caught;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route('/api', name: 'route_api')]
#[IsGranted('ROLE_ADMIN')]
class ApiController extends AbstractController
{

  private EntityManagerInterface $entityManager;

  public function __construct(EntityManagerInterface $entityManager)
  {
    $this->entityManager = $entityManager;
  }

  #[Route('/pokedex', name: 'api_pokedex')]
  public function getPokedex(): Response
  {

    $connection = $this->entityManager->getConnection();

    $reqPokedex = 'SELECT p.pokedex_id, p.name_fr, g.number AS generation, 
    GROUP_CONCAT(t.name SEPARATOR ";") AS type_name, GROUP_CONCAT(t.logo SEPARATOR ";") AS type_logo
    FROM pokemon AS p
    JOIN type_pokemon ON type_pokemon.pokemon_id = p.id
    JOIN type AS t ON t.id = type_pokemon.type_id
    JOIN generation AS g ON g.id = p.generation_id
    GROUP BY p.pokedex_id, p.name_fr, g.number';

    $statement = $connection->executeQuery($reqPokedex);
    $lePokedex = $statement->fetchAllAssociative();

    $pokedex = array();
    foreach ($lePokedex as $pokemon) {
      $pokedex[] = array(
        "pokedex_id" => $pokemon["pokedex_id"],
        "name_fr" => $pokemon["name_fr"],
        "generation" => $pokemon["generation"],
        "name_type" => $pokemon["type_name"],
        "logo_type" => $pokemon["type_logo"],
      );
    }

    return new JsonResponse($pokedex);

  }

  #[Route('/pokemon/{pokedex_id}', name: 'api_pokemon')]
  public function getPokemon($pokedex_id): Response
  {

    $connection = $this->entityManager->getConnection();

    // Prévolutions
    $reqPrevolutions = 'SELECT pokedex_id, name_fr FROM pokemon WHERE id IN (SELECT pokemon_source
      FROM pokemon_pokemon WHERE pokemon_target = (SELECT id FROM pokemon WHERE pokedex_id = ' . $pokedex_id . '))';

    $statement = $connection->executeQuery($reqPrevolutions);
    $lesPrevolutions = $statement->fetchAllAssociative();

    $prevolutions = array();
    foreach ($lesPrevolutions as $prevolution) {
      $prevolutions[] = array(
        "pokedex_id" => $prevolution["pokedex_id"],
        "name_fr" => $prevolution["name_fr"],
      );
    }

    // Evolutions
    $reqEvolutions = 'SELECT pokedex_id, name_fr FROM pokemon WHERE id IN (SELECT pokemon_target
      FROM pokemon_pokemon WHERE pokemon_source = (SELECT id FROM pokemon WHERE pokedex_id = ' . $pokedex_id . '))';

    $statement = $connection->executeQuery($reqEvolutions);
    $lesEvolutions = $statement->fetchAllAssociative();
    $evolutions = array();
    foreach ($lesEvolutions as $evolution) {
      $evolutions[] = array(
        "pokedex_id" => $evolution["pokedex_id"],
        "name_fr" => $evolution["name_fr"],
      );
    }

    // Pokemon
    $pokemon = $this->entityManager->getRepository(Pokemon::class)->findOneBy(['pokedex_id' => $pokedex_id]);

    // Types
    $varTypes = $pokemon->getPokemonHasType();
    $types = array();
    foreach ($varTypes as $type) {
      $types[] = array(
        "type" => $type->getLogo(),
      );
    }

    // Abilities
    $varAbilities = $pokemon->getPokemonHasAbility();
    $abilities = array();
    foreach ($varAbilities as $ability) {
      $abilities[] = array(
        "ability" => $ability->getName(),
        "hidden" => $ability->isHidden(),
      );
    }

    $pokeArray[] = array(
      array("pokedex_id" => $pokemon->getPokedexId()),
      array("generation" => $pokemon->getGeneration()->getNumber()),
      array("types" => $types),
      array("name_fr" => $pokemon->getNameFr()),
      array("name_en" => $pokemon->getNameEn()),
      array("name_jp" => $pokemon->getNameJp()),
      array("vit" => $pokemon->getVit()),
      array("atk" => $pokemon->getAtk()),
      array("def" => $pokemon->getDef()),
      array("spe_atk" => $pokemon->getSpeAtk()),
      array("spe_def" => $pokemon->getSpeDef()),
      array("hp" => $pokemon->getHp()),
      array("weight" => $pokemon->getWeight()),
      array("height" => $pokemon->getHeight()),
      array("category" => $pokemon->getCategory()),
      array("abilities" => $abilities),
      array("prevolutions" => $prevolutions),
      array("evolutions" => $evolutions),
    );

    return new JsonResponse($pokeArray);
  }


  #[Route('/teams', name: 'api_teams')]
  public function getTeams(): Response
  {
    $teams = array();
    $user = $this->getUser();
    if (isset($user)) {

      $lesTeams = $this->entityManager->getRepository(Team::class)->findBy(['user' => $user]);
      foreach ($lesTeams as $team) {
        $pokemons = array();
        $lesPokemons = $team->getPokemonAsTeam();
        foreach ($lesPokemons as $pokemon) {
          $pokemons[] = array(
            "pokedex_id" => $pokemon->getPokedexId(),
            "name_fr" => $pokemon->getNameFr(),
          );
        }
        $teams[] = array(
          "name" => $team->getName(),
          "pokemons" => $pokemons,
        );
      }
      return new JsonResponse($teams);
    }
    else {
      return $this->redirectToRoute('api_login', [], Response::HTTP_SEE_OTHER);
    }

  }

  #[Route('/shinydex', name: 'api_shinydex')]
  public function getShinyDex(): Response
  {
    $user = $this->getUser();
    if (isset($user)) {
      // Shinydex
      $lesShiny = $user->getCaught();
      foreach ($lesShiny as $caught) {
        $shinydex[] = array(
          "pokedex_id" => $caught->getPokemon()->getPokedexId(),
          "sprite_shiny" => $caught->getPokemon()->getSpriteShiny(),
          "date_capture" => $caught->getDateCapture(),
        );
      }

      // Générations
      $lesGenerations = $this->entityManager->getRepository(Generation::class)->findAll();
      foreach ($lesGenerations as $generation) {
        $generations[] = array(
          "number" => $generation->getNumber(),
          "nbOfPokemon" => count($this->entityManager->getRepository(Pokemon::class)->findBy(['generation' => $generation->getId()])),
        );
      }

      // Construction du JSON
      $responseShiny[] = array(
        "generations" => $generations,
        "shinydex" => $shinydex,
        "datas" => array(
          "total_caught" => $user->getNumberOfCaught(),
          "total_pokemon" => count($this->entityManager->getRepository(Pokemon::class)->findAll()),
        ),
      );

      return new JsonResponse($responseShiny);
    }
    else {
      return $this->redirectToRoute('api_login', [], Response::HTTP_SEE_OTHER);
    }

  }

  #[Route('/home', name: 'api_homepage')]
  public function getHomePage(): Response
  {
    // Connexion
    $connection = $this->entityManager->getConnection();

    // Récupère les top shasses du jour
    $sql = 'SELECT pokemon.name_fr AS pokemon, COUNT(caught.id) AS occurrences
        FROM pokemon
        INNER JOIN caught ON pokemon.id = caught.pokemon_id
        WHERE DATE(caught.date_capture) = CURDATE()
        GROUP BY pokemon.id
        ORDER BY COUNT(caught.id) DESC, pokemon.name_fr
        LIMIT 3';

    $statement = $connection->executeQuery($sql);
    $resultTopShasse = $statement->fetchAllAssociative();

    foreach ($resultTopShasse as $unTopShasse) {
      $topShasses[] = array(
        "pokemon" => $unTopShasse['pokemon'],
        "occurrences" => $unTopShasse['occurrences'],
      );
    }

    // Récupère les top dresseurs
    $sql = 'SELECT user.pseudo AS dresseur, COUNT(caught.user_id) AS occurrences
        FROM user
        INNER JOIN caught ON user.id = caught.user_id
        GROUP BY user.id
        ORDER BY COUNT(caught.id) DESC, user.pseudo
        LIMIT 3';


    $statement = $connection->executeQuery($sql);
    $resultTopDresseur = $statement->fetchAllAssociative();

    foreach ($resultTopDresseur as $unResult) {
      $topDresseurs[] = array(
        "pseudo" => $unResult['dresseur'],
        "nb_Shiny" => $unResult['occurrences'],
      );
    }


    // Récupère les shiny du jour
    $dateOfTheDay = date('Y-m-d');
    $dateDuJour = new \DateTime($dateOfTheDay);
    $dateDuJour = $dateDuJour->modify('-5 days');

    for ($i = 5; $i >= 1; $i--) {
      $dateDuJourMoins5Jours = $dateDuJour->modify('+1 days');
      $caughts = count($this->entityManager->getRepository(Caught::class)->findBy(['date_capture' => $dateDuJourMoins5Jours]));
      $shinyDuJour[] = array(
        "date_capture" => $dateDuJour->format('Y-m-d'),
        "nb_capture" => $caughts,
      );
    }

    // Récupère les tops pokemons team
    $sql = 'SELECT COUNT(team_pokemon.pokemon_id) AS occurrences, pokemon.name_fr
    FROM team_pokemon
    JOIN pokemon ON pokemon.id = team_pokemon.pokemon_id
    GROUP BY pokemon.name_fr
    ORDER BY occurrences DESC
    LIMIT 3';

    $statement = $connection->executeQuery($sql);
    $resultTopPokemonInTeam = $statement->fetchAllAssociative();

    foreach ($resultTopPokemonInTeam as $unPoke) {
      $topPokemonTeam[] = array(
        'name_fr' => $unPoke['name_fr'],
        'occurrence' => $unPoke['occurrences'],
      );
    }

    $responseHomePage[] = array(
      "topShasses" => $topShasses,
      "topDresseurs" => $topDresseurs,
      "shinyDuJour" => $shinyDuJour,
      "topPokemonTeam" => $topPokemonTeam,
    );

    return new JsonResponse($responseHomePage);
  }

  #[Route('/login', name: 'api_login', methods: ['POST'])]
  public function login(AuthenticationUtils $authenticationUtils): Response
  {
    // get the login error if there is one
    $error = $authenticationUtils->getLastAuthenticationError();
    // last username entered by the user
    $lastUsername = $authenticationUtils->getLastUsername();
    
    return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
  }
  
  #[Route(path: '/logout', name: 'app_logout')]
  public function logout(): void
  {
    throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
  }

}
