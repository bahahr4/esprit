<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Entity\Reply;
use App\Form\ReclamationType;
<<<<<<< HEAD
use App\Form\ReplyType;
=======
>>>>>>> 273b3dc5a7dc47d103f3e51cc1635e6c06d06212
use App\Repository\ReclamationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
<<<<<<< HEAD
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reclamation')]
final class ReclamationController extends AbstractController
{
    // Route pour afficher la liste des réclamations
    #[Route(name: 'app_reclamation_index', methods: ['GET'])]
    public function index(ReclamationRepository $reclamationRepository): Response
    {
        $reclamations = $reclamationRepository->findAll();
        $newReclamationsCount = $reclamationRepository->countLast7DaysReclamations();

        return $this->render('reclamation/index.html.twig', [
            'reclamations' => $reclamations,
            'newReclamationsCount' => $newReclamationsCount,
        ]);
    }

    // Route pour créer une nouvelle réclamation
    #[Route('/new', name: 'app_reclamation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // La date est déjà initialisée via le constructeur
            $entityManager->persist($reclamation);
            $entityManager->flush();

            return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reclamation/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
=======
use Symfony\Component\Routing\Attribute\Route;

#[Route('/reclamation')]
final class ReclamationController extends AbstractController
{#[Route('/', name: 'app_reclamation_index', methods: ['GET'])]
public function index(EntityManagerInterface $entityManager): Response
{
    // Fetch all reclamations
    $reclamations = $entityManager->getRepository(Reclamation::class)->findAll();

    // Optionally, fetch the replies for each reclamation to check if a reply exists
    foreach ($reclamations as $reclamation) {
        $reclamation->hasReply = $entityManager->getRepository(Reply::class)
            ->findOneBy(['reclamation' => $reclamation]);
    }

    return $this->render('reclamation/index.html.twig', [
        'reclamations' => $reclamations,
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
>>>>>>> 273b3dc5a7dc47d103f3e51cc1635e6c06d06212
        ]);
    }


<<<<<<< HEAD
    // Route pour afficher une réclamation spécifique
=======
>>>>>>> 273b3dc5a7dc47d103f3e51cc1635e6c06d06212
    #[Route('/{id}', name: 'app_reclamation_show', methods: ['GET'])]
    public function show(Reclamation $reclamation): Response
    {
        return $this->render('reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }
<<<<<<< HEAD

    // Route pour modifier une réclamation existante
    #[Route('/{id}/edit', name: 'app_reclamation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
        ]);
    }

    // Route pour supprimer une réclamation
    #[Route('/{id}', name: 'app_reclamation_delete', methods: ['POST'])]
    public function delete(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $reclamation->getId(), $request->get('_token'))) {
            $entityManager->remove($reclamation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
    }

    // Route pour créer une nouvelle réponse à une réclamation spécifique
    #[Route('/reply/new/{id}', name: 'app_reply_new', methods: ['GET', 'POST'])]
    public function replyNew(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        $reply = new Reply();
        $reply->setReclamation($reclamation);

        $form = $this->createForm(ReplyType::class, $reply);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reply);
            $entityManager->flush();

            return $this->redirectToRoute('app_reclamation_show', ['id' => $reclamation->getId()]);
        }

        return $this->render('reclamation/replynew.html.twig', [
            'reply' => $reply,
            'form' => $form,
        ]);
    }
=======
    #[Route('user/{id}', name: 'app_reclamation_usershow', methods: ['GET'])]
    public function shosw(Reclamation $reclamation): Response
    {
        return $this->render('reclamation/show_user.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }




>>>>>>> 273b3dc5a7dc47d103f3e51cc1635e6c06d06212
}
