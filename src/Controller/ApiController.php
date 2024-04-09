<?php
 
<<<<<<< HEAD
namespace App\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
 
#[IsGranted('ROLE_ADMIN')]
class ApiController extends AbstractController
{
    #[Route('/custom_api', name: 'app_api')]
    public function index(): Response
    {
      return new JsonResponse("OK");
    }
}
=======
 namespace App\Controller;
  
 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use Symfony\Component\HttpFoundation\JsonResponse;
 use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\Routing\Annotation\Route;
 use Symfony\Component\Security\Http\Attribute\IsGranted;
  
 #[IsGranted('ROLE_ADMIN')]
 class ApiController extends AbstractController
 {
     #[Route('/custom_api', name: 'app_api')]
     public function index(): Response
     {
       return new JsonResponse("OK");
     }
 }
>>>>>>> master
