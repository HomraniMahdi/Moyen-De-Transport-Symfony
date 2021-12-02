<?php

namespace App\Controller;

use App\Repository\MoyenDeTransportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashBoardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dash_board")
     */
    public function index(): Response
    {
        return $this->render('dashboard.html.twig', [
            'controller_name' => 'DashBoardController',
        ]);
    }

    /**
     * @Route("/statistiques", name="statistiques")
     */
    public function stats(): Response
    {
        return $this->render('moyen_de_transport/Statistique.html.twig');

    }

    /**
     *
     * @Route("/statistiques/type", name="type_statistiques")
     */
    public function type_stats(MoyenDeTransportRepository $moyenTransportRepo): JsonResponse
    {
        $bus = 0;
        $train = 0;
        $metro = 0;
        $moyenTransport = $moyenTransportRepo->findAll();
        foreach ($moyenTransport as $item) {
            if (strcmp(strtolower($item->getType()), "bus") == 0) $bus++;
            if (strcmp(strtolower($item->getType()), "train") == 0) $train++;
            if (strcmp(strtolower($item->getType()), "metro") == 0) $metro++;
        }
        $data = array("Bus" => $bus, "Train" => $train, "Métro" => $metro);
        return new JsonResponse($data);
    }
}
