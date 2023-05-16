<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersoneGiuridicheController extends AbstractController
{
    #[Route('/persone_giuridiche', name: 'app_persone_giuridiche')]



    public function index(): Response
    {



        return $this->render('persone_giuridiche/index.html.twig', [
            'controller_name' => 'PersoneGiuridicheController',
        ]);
    }
}
