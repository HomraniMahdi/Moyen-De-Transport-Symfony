<?php

namespace App\Controller;

use App\api\MailerApi;
use App\api\TwilioApi;
use App\Entity\MoyenDeTransport;
use App\Form\MoyenDeTransportType;
use App\Repository\MoyenDeTransportRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/moyen/de/transport")
 */
class MoyenDeTransportController extends AbstractController
{
    /**
     * @Route("/", name="moyen_de_transport_index", methods={"GET"})
     */
    public function index(MoyenDeTransportRepository $moyenDeTransportRepository): Response
    {
        return $this->render('moyen_de_transport/index.html.twig', [
            'moyen_de_transports' => $moyenDeTransportRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="moyen_de_transport_new", methods={"GET", "POST"})
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function new(Request $request, EntityManagerInterface $entityManager,MailerInterface $mailer): Response
    {
        $moyenDeTransport = new MoyenDeTransport();
        $form = $this->createForm(MoyenDeTransportType::class, $moyenDeTransport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($moyenDeTransport);
            $entityManager->flush();


            $email = new MailerApi();
            $twilio = new TwilioApi('ACcb016d5d5b4e05ea366d44ec5227e10c','ac4747a918aeb184c86281050488de22','+12565679612');
            $twilio->sendSMS('+21658932889','Moyen de Transport Créer avec success');
            $email->sendEmail( $mailer,'tunisport32@gmail.com','mahdi.homrani@esprit.tn','testing email','Moyen de Transport Créer avec success');

            return $this->redirectToRoute('moyen_de_transport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('moyen_de_transport/new.html.twig', [
            'moyen_de_transport' => $moyenDeTransport,
            'form' => $form->createView(),
        ]);


    }

    /**
     * @Route("/{id}", name="moyen_de_transport_show", methods={"GET"})
     */
    public function show(MoyenDeTransport $moyenDeTransport): Response
    {
        return $this->render('moyen_de_transport/show.html.twig', [
            'moyen_de_transport' => $moyenDeTransport,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="moyen_de_transport_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, MoyenDeTransport $moyenDeTransport, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MoyenDeTransportType::class, $moyenDeTransport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('moyen_de_transport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('moyen_de_transport/edit.html.twig', [
            'moyen_de_transport' => $moyenDeTransport,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}", name="moyen_de_transport_delete", methods={"POST"})
     */
    public function delete(Request $request, MoyenDeTransport $moyenDeTransport, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$moyenDeTransport->getId(), $request->request->get('_token'))) {
            $entityManager->remove($moyenDeTransport);
            $entityManager->flush();
        }

        return $this->redirectToRoute('moyen_de_transport_index', [], Response::HTTP_SEE_OTHER);
    }
}