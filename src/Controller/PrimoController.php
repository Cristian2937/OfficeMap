<?php

namespace App\Controller;

use App\Entity\Model\UtenteModel;
use App\Repository\PersonaFisicaRepository;
use App\Repository\UtenteRepository;
use Doctrine\DBAL\Types\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrimoController extends AbstractController
{
    //public UtenteRepository $utenteRepository = new UtenteRepository();

    //#[Security("is_granted('ROLE_ADMIN') and is_granted('ROLE_COORD') and is_granted('ROLE_USER')")]
    #[Route('/home', name: 'home')]
    /*#[Route('/prova', name: 'prova')]*/
    public function helloWorld(): Response
    {




        return $this->render('Primo/hello.html.twig', [
            "name" => 'Mario',
        ]);
        //return $this->json("Hello World");

    }

//    #[Route('/prova', name:'prova')]
//    public function persona(PersonaFisicaRepository $persone): Response
//    {
//        $per = $persone->findAll();
//
//        return $this->render('prova/prova.html.twig',[
//           "persone"=>$per
//        ]);
//
//    }

    #[Route('/gestione_utenti/utenti',name:'gestione_utenti')]
    public function visualizzaUtenti(UtenteModel $utenteModel):Response
    {
        $allUtenti = $utenteModel->findAll();
     $listaUtenti = [];

    return $this->render("gestione/utenti.html.twig",[
        'allUtenti'=> $allUtenti,
    ]);
     /*foreach ($this->utenteRepository as $utente)
     {
         $listaUtenti[] = new UtenteModel($utente);
    }*/


       // return $this->json($listaUtenti);
    }

}