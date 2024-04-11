<?php
 
namespace App\Controller;
 
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Entity\Pokemon;
use App\Entity\Team;
use App\Entity\Generation;
use App\Entity\User;
 
#[Route('/api', name: 'route_api')]
#[IsGranted('ROLE_ADMIN')]
class ApiController extends AbstractController
{
  
  private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
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
      FROM pokemon_pokemon WHERE pokemon_target = (SELECT id FROM pokemon WHERE pokedex_id = '.$pokedex_id . '))';

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
      FROM pokemon_pokemon WHERE pokemon_source = (SELECT id FROM pokemon WHERE pokedex_id = '.$pokedex_id . '))';

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
      if(isset($user)) {

        $lesTeams = $this->entityManager->getRepository(Team::class)->findBy(['user' => $user]);
        foreach ($lesTeams as $team){
          $pokemons = array();
          $lesPokemons = $team->getPokemonAsTeam();
          foreach ($lesPokemons as $pokemon){
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
      }
        
      return new JsonResponse($teams);
    }

    #[Route('/shinydex', name: 'api_shinydex')]
    public function getShinyDex(): Response
    {
      $user = $this->getUser();
      if(isset($user)) {
        // Shinydex
        $lesShiny = $user->getCaught();
        foreach ($lesShiny as $caught){
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
          );
        }
      }
      
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
}
