<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Team;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class TeamsController extends AbstractController
{
    #[Route('/teams', name: 'app_teams')]
    public function index(EntityManagerInterface $entityManager): Response
    {   
        $teamsManager = $entityManager->getRepository(Team::class);
        $user = $this->getUser();
        if ($user != null){ 
            $teams = $teamsManager->findBy(['user'=>$user->getId()]);
            return $this->render('teams/index.html.twig', [
                'teams' => $teams,        
            ]);
        }else{
            return $this->render('security/login.html.twig', [              
            ]);
        }
        
    }
}
