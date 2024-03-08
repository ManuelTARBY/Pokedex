<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UpdateprofileController extends AbstractController
{
    #[Route('/updateprofile', name: 'app_updateprofile')]
    public function index(): Response
    {
        return $this->render('updateprofile/index.html.twig', [
            'controller_name' => 'UpdateprofileController',
        ]);
    }
}
