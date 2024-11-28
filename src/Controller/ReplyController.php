<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Entity\Reply;
use App\Form\ReplyType;
use App\Repository\ReplyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/reply')]
final class ReplyController extends AbstractController
{
    #[Route(name: 'app_reply_index', methods: ['GET'])]
    public function index(ReplyRepository $replyRepository): Response
    {
        return $this->render('reply/index.html.twig', [
            'replies' => $replyRepository->findAll(),
        ]);
    }

    #[Route('/reclamation/{id}/reply/new', name: 'app_reply_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Reclamation $reclamation): Response
    {
        // Create a new Reply object
        $reply = new Reply();

        // Associate the reply with the selected reclamation
        $reply->setReclamation($reclamation);
        $reply->setCreatedate(new \DateTime());
        // Create the form
        $form = $this->createForm(ReplyType::class, $reply);
        $form->handleRequest($request);

        // If the form is submitted and valid, persist the reply
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reply);
            $entityManager->flush();

            // Redirect to the reclamation show page
            return $this->redirectToRoute('app_reclamation_index');
        }

        // Render the form to reply
        return $this->render('reply/new.html.twig', [
            'form' => $form->createView(),
            'reclamation' => $reclamation,
        ]);
    }

    #[Route('/{id}', name: 'app_reply_show', methods: ['GET'])]
    public function show(Reply $reply): Response
    {
        return $this->render('reply/show.html.twig', [
            'reply' => $reply,
        ]);
    }
    #[Route('user/{id}', name: 'app_reply_show_user', methods: ['GET'])]
    public function shogw(Reply $reply): Response
    {
        return $this->render('reclamation/showreply.html.twig', [
            'reply' => $reply,
        ]);
    }


}
