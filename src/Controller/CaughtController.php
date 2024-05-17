<?php

namespace App\Controller;

use App\Entity\Caught;
use App\Form\CaughtType;
use App\Repository\CaughtRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Console\Output\OutputInterface;

#[Route('/caught')]
class CaughtController extends AbstractController
{
    #[Route('/', name: 'app_caught_index', methods: ['GET'])]
    public function index(CaughtRepository $caughtRepository): Response
    {
        return $this->render('caught/index.html.twig', [
            'caughts' => $caughtRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_caught_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $caught = new Caught();
        $form = $this->createForm(CaughtType::class, $caught);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                $lePokemon = $form->getData()->getPokemon();
                $result = $entityManager->getRepository(Caught::class)->findOneBy(['pokemon' => $lePokemon, 'user' => $this->getUser()]);
                if (!$result) {

                    $dateDuJour = new \DateTime();
                    $caught->setDateCapture($dateDuJour);
                    $caught->setUser($this->getUser());
                    $entityManager->persist($caught);
                    $entityManager->flush();
                }

            return $this->redirectToRoute('app_shinydex', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('caught/new.html.twig', [
            'caught' => $caught,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_caught_show', methods: ['GET'])]
    public function show(Caught $caught): Response
    {
        return $this->render('caught/show.html.twig', [
            'caught' => $caught,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_caught_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Caught $caught, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CaughtType::class, $caught);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_caught_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('caught/edit.html.twig', [
            'caught' => $caught,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_caught_delete', methods: ['POST'])]
    public function delete(Request $request, Caught $caught, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$caught->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($caught);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_caught_index', [], Response::HTTP_SEE_OTHER);
    }
}
