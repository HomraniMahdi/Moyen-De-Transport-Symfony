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
    public function home(MailerInterface $mailer): Response
    {
        $email = new MailerApi();
        $twilio = new TwilioApi('ACcb016d5d5b4e05ea366d44ec5227e10c','ac4747a918aeb184c86281050488de22','+12565679612');
        $twilio->sendSMS('+21658932889','hello from twilio');
        $email->sendEmail( $mailer,'tunisport32@gmail.com','mahdi.homrani@esprit.tn','testing email','hello from Mailer to mahdi ');
        return $this->render('/demo/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }


    /**
     * @Route("/map", name="map")
     *
     */

    public function maps(): Response
    {

        return $this->render('map.html', [
            'controller_name' => 'IndexController',
        ]);
    }

}
