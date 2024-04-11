<?php
 
namespace App\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Pokemon;
use App\Entity\Team;
use App\Entity\User;
 
#[IsGranted('ROLE_ADMIN')]
class ApiController extends AbstractController
{
    #[Route('/capi', name: 'app_api')]
    public function index(EntityManagerInterface $entityManager): Response
    { 
        $pokemons = 'Bonjour';
        return new JsonResponse($pokemons);
    }

    #[Route('/capi/teams', name: 'api_teams')]
    public function itsShowTeams(EntityManagerInterface $entityManager)
    { 
        $teamsManager = $entityManager->getRepository(Team::class);
        $user = $this->getUser();
        if ($user != null){ 
            $teams = $teamsManager->findBy(['user'=>$user->getId()]);
            $j_teams = [];
            foreach($teams as $team){
                $j_pokemons = [];
                foreach($team->getPokemonAsTeam() as $pokemon){
                    $j_pokemons[] = array(
                        array(["pokedex_id" => $pokemon->getPokedexId()]),
                        array(["sprite_regular" => $pokemon->getSpriteRegular()]),
                    );
                }
                $j_teams[] = array([$team->getName() => $j_pokemons]);
            };
            return new JsonResponse($j_teams);
        }else{
            return $this->render('security/login.html.twig');
        }

    }

}
