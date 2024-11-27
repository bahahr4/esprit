<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/reclamation')]
final class ReclamationController extends AbstractController
{
    #[Route(name: 'app_reclamation_index', methods: ['GET'])]
    public function index(ReclamationRepository $reclamationRepository): Response
    {
        return $this->render('reclamation/index.html.twig', [
            'reclamations' => $reclamationRepository->findAll(),
        ]);
    }
    #[Route('reclamation_user',name: 'app_reclamation_user', methods: ['GET'])]
    public function indeex(ReclamationRepository $reclamationRepository): Response
    {
        $user = $this->getUser();


        return $this->render('reclamation/reclamationuser.html.twig', [
            'reclamations' => $reclamationRepository->findAll(),
        ]);
    }
    #[Route('/new', name: 'app_reclamation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Create a new Reclamation object
        $reclamation = new Reclamation();

        // Get the current user and set the email and date
        $user = $this->getUser();
        $reclamation->setDateRecl(new \DateTime());  // Setting today's date
        $reclamation->setEmail($user->getUserIdentifier());

        // Create the form and handle the request
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        // If the form is submitted and valid, persist the data and redirect
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reclamation);
            $entityManager->flush();

            return $this->redirectToRoute('app_reclamation_user');
        }

        // If the form is not valid, show it with errors
        return $this->render('reclamation/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/{id}', name: 'app_reclamation_show', methods: ['GET'])]
    public function show(Reclamation $reclamation): Response
    {
        return $this->render('reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }
    #[Route('user/{id}', name: 'app_reclamation_usershow', methods: ['GET'])]
    public function shosw(Reclamation $reclamation): Response
    {
        return $this->render('reclamation/show_user.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }




}
