<?php

namespace App\Controller;

use App\Entity\Team;
use App\Form\TeamType;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/teams')]
class TeamsController extends AbstractController
{
    /**
     * Récupère les informations sur les teams et les envoie à la vue de la page des teams
     *
     * @param TeamRepository $teamRepository
     * @return Response
     */
    #[Route('/', name: 'app_teams_index', methods: ['GET'])]
    public function index(TeamRepository $teamRepository): Response
    {
        $user = $this->getUser();
        if ($user != null){ 
            $teams = $teamRepository->findBy(['user'=>$user->getId()]);
            return $this->render('teams/index.html.twig', [
                'teams' => $teams,        
            ]);
        }else{
            return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
        }
    }

    /**
     * Envoie vers le formulaire de création d'une nouvelle équipe
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/new', name: 'app_teams_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $team = new Team();
        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $team->setUser($this->getUser());
            for ($i=1; $i<7; $i++){
                $team->addPokemonAsTeam(($form->get('Pokemon_'.$i)->getData()));
                $entityManager->persist($team);
            }
            $entityManager->flush();
            return $this->redirectToRoute('app_teams_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('teams/new.html.twig', [
            'team' => $team,
            'form' => $form,
        ]);
    }

    // /**
    //  * 
    //  */
    // #[Route('/{id}', name: 'app_teams_show', methods: ['GET', 'POST'])]
    // public function show(Team $team, Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     if ($request->isMethod('GET')) {
    //         return $this->render('teams/show.html.twig', [
    //             'team' => $team,
    //         ]);
    //     }
    //     else{
    //         if ($this->isCsrfTokenValid('delete'.$team->getId(), $request->getPayload()->get('_token'))) {
    //             $entityManager->remove($team);
    //             $entityManager->flush();
    //         }
    //         return $this->redirectToRoute('app_teams_index', [], Response::HTTP_SEE_OTHER);
    //     }
    // }

       /**
     * Envoie vers la vue du formulaire d'édition de Team
     */
    #[Route('/{id}/edit', name: 'app_teams_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Team $team, $id, EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser()->getId() == $id or in_array("ROLE_ADMIN", ($this->getUser()->getRoles()))){
            $form = $this->createForm(TeamType::class, $team);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                for ($i=1; $i<7; $i++){
                    if ($team->getPokemonAsTeam()[$i-1]){
                        $team->removePokemonAsTeam($team->getPokemonAsTeam()[$i-1]);
                        $entityManager->persist($team);
                    }                 
                }
                $entityManager->flush();
                for ($i=1; $i<7; $i++){
                    $team->addPokemonAsTeam(($form->get('Pokemon_'.$i)->getData()));
                    $entityManager->persist($team);
                }
                $entityManager->flush();
                return $this->redirectToRoute('app_teams_index', [], Response::HTTP_SEE_OTHER);
            }

            return $this->render('teams/edit.html.twig', [
                'team' => $team,
                'form' => $form,
            ]);
        }else{
            return $this->render('user/not_allowed.html.twig');
        }
    }

    /**
     * Envoie vers la vue du formulaire de suppression de Team
     */
    #[Route('/{id}', name: 'app_teams_delete', methods: ['POST'])]
    public function delete(Request $request, Team $team, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$team->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($team);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_teams_index', [], Response::HTTP_SEE_OTHER);
    }
}
