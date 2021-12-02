<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\api\MailerApi;
use App\api\TwilioApi;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;


class IndexController extends AbstractController
{


    /**
     * @Route("/", name="index")
     */
    public function home(): Response
    {
        return $this->render('/demo/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
