<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Team;
use Doctrine\ORM\EntityManagerInterface;

class TeamsController extends AbstractController
{
    #[Route('/teams', name: 'app_teams')]
    public function index(EntityManagerInterface $entityManager): Response
    {   
        $teams = $entityManager->getRepository(Team::class)->findAll();
        return $this->render('teams/index.html.twig', [
            'teams' => $teams,
        ]);
    }
}
