<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ShinydexController extends AbstractController
{
    #[Route('/shinydex', name: 'app_shinydex')]
    public function index(): Response
    {
        return $this->render('shinydex/index.html.twig', [
            'controller_name' => 'ShinydexController',
        ]);
    }
}
