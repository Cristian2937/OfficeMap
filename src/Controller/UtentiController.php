<?php

namespace App\Controller;

use App\Entity\Model\UtenteModel;
use App\Entity\PersonaFisica;
use App\Entity\Utente;
use App\Enum\StatoWorkflow;
use App\Form\PersonaFisicaFormType;
use App\Form\UtenteFormType;
use App\Form\UtentiFormType;
use App\Form\UtentiType;
use App\Repository\PersonaFisicaRepository;
use App\Repository\UtenteRepository;
use Symfony\Component\HttpFoundation\Request;
//use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UtentiController extends AbstractController
{
    #[Route('/utenti', name: 'app_utenti')]
    public function index(UtenteRepository $utenteRepository/*,UtenteModel $model*/): Response
    {

        $listaUtenti = [];
        foreach($utenteRepository->findAll() as $utente){

                $utenteModel =  new UtenteModel($utente);
                $listaUtenti[] =$utenteModel;


        }

        return $this->render("gestione/utenti.html.twig",[
            'allUtenti'=> $listaUtenti,
        ]);
    }



    #[Route('utenti/{id}/edit', name:'app_gestici_utenti_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request,Utente $utente, UtenteRepository $utenteRepository):Response
    {

        $form = $this->createForm(UtentiType::class, $utente);
        //$personaFisicaForm = $this->createForm(PersonaFisicaFormType::class,$utente);
        $form->handleRequest($request);
        //$personaFisicaForm->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $utenteRepository->save($utente,true);
            return $this->redirectToRoute('app_utenti',[],Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('gestione/edit.html.twig', [
            'utente' => $utente,
            'form' => $form,
            //'pFisicaForm'=> $personaFisicaForm,
        ]);
    }


}
