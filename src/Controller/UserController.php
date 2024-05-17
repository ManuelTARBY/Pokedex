<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Error;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {   
        $user = $this->getUser();
        if ($user != null){ 
            return $this->render('user/index.html.twig', [
                'user' => $user,
            ]);
        }else{
            return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
        }
    }

    #[Route('/gestion', name: 'app_user_gestion', methods: ['GET', 'POST'])]
    public function gestion(Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {
        if ($this->getUser() != null and in_array("ROLE_ADMIN", ($this->getUser()->getRoles()))){
            $user = new User();
            $users = $userRepository->findAll();
            $form = $this->createForm(UserType::class, $user);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->persist($user);
                $entityManager->flush();
                return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
            }

            return $this->render('user/gestion.html.twig', [
                'user' => $user,
                'users' => $users,
                'form' => $form,
            ]);
        }else{
            return $this->render('user/not_allowed.html.twig');
        }
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager, $id): Response
    {
        if ($this->getUser()->getId() == $id or in_array("ROLE_ADMIN", ($this->getUser()->getRoles()))){
            $form = $this->createForm(UserType::class, $user);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->flush();

                return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
            }
            return $this->render('user/edit.html.twig', [
                'user' => $user,
                'form' => $form,
            ]);
        }else{
                return $this->render('user/not_allowed.html.twig');
            }
        
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }
        return $this->redirectToRoute('app_user_gestion', [], Response::HTTP_SEE_OTHER);
    }
}
