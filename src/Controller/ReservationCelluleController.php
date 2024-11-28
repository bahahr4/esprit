<?php

namespace App\Controller;

use App\Entity\ReservationCellule;
use App\Form\ReservationCelluleType;
use App\Repository\ReservationCelluleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/reservation_cellule')]
final class ReservationCelluleController extends AbstractController
{
    #[Route(name: 'app_reservation_cellule_index', methods: ['GET'])]
    public function index(ReservationCelluleRepository $reservationCelluleRepository): Response
    {
        return $this->render('reservation_cellule/index.html.twig', [
            'reservation_cellules' => $reservationCelluleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reservation_cellule_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservationCellule = new ReservationCellule();
        $user = $this->getUser();
        $reservationCellule->setName($user->getName());
        $reservationCellule->setEmail($user->getUserIdentifier());
        $reservationCellule->setCreatedAt(new \DateTime());
        $reservationCellule->setName($user->getPhoneNumber());
        $form = $this->createForm(ReservationCelluleType::class, $reservationCellule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservationCellule);
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_cellule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservation_cellule/new.html.twig', [
            'reservation_cellule' => $reservationCellule,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_cellule_show', methods: ['GET'])]
    public function show(ReservationCellule $reservationCellule): Response
    {
        return $this->render('reservation_cellule/show.html.twig', [
            'reservation_cellule' => $reservationCellule,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reservation_cellule_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ReservationCellule $reservationCellule, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationCelluleType::class, $reservationCellule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_cellule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservation_cellule/edit.html.twig', [
            'reservation_cellule' => $reservationCellule,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_cellule_delete', methods: ['POST'])]
    public function delete(Request $request, ReservationCellule $reservationCellule, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationCellule->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($reservationCellule);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservation_cellule_index', [], Response::HTTP_SEE_OTHER);
    }
}
