<?php

namespace App\Controller;

use App\Entity\Model\UtenteModel;
use App\Entity\PersonaFisica;
use App\Entity\Utente;
use App\Form\PersonaFisicaFormType;
use App\Form\UtenteType;
use App\Repository\UtenteRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/utente')]
class UtenteController extends AbstractController
{
    #[Route('/', name: 'app_utente_index', methods: ['GET'])]
    public function index(UtenteRepository $utenteRepository): Response
    {


        return $this->render('utente/index.html.twig', [
            'utentes' => $utenteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_utente_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UtenteRepository $utenteRepository): Response
    {
        $utente = new Utente();
        $form = $this->createForm(UtenteType::class, $utente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $utenteRepository->save($utente, true);

            return $this->redirectToRoute('app_utente_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('utente/new.html.twig', [
            'utente' => $utente,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_utente_show', methods: ['GET'])]
    public function show(Utente $utente): Response
    {
        return $this->render('utente/show.html.twig', [
            'utente' => $utente,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_utente_edit', methods: ['GET', 'POST'])]
    /*#[ParamConverter('persona',class: PersonaFisica::class)]*/
    public function edit(Request $request, Utente $utente,UtenteRepository $utenteRepository): Response
    {
        //$model = new UtenteModel($utente);
        $form = $this->createForm(UtenteType::class, $utente);


        $form->handleRequest($request);
        //$formPFisica->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$utente->setPersoneFisiche($personaFisica);
            $utenteRepository->save($utente, true);

            return $this->redirectToRoute('app_utente_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('utente/edit.html.twig', [
            'utente' => $utente,
            'form' => $form,
            /*'formPersonaFisica'=> $formPFisica,*/
        ]);
    }

    #[Route('/{id}', name: 'app_utente_delete', methods: ['POST'])]
    public function delete(Request $request, Utente $utente, UtenteRepository $utenteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$utente->getId(), $request->request->get('_token'))) {
            $utenteRepository->remove($utente, true);
        }

        return $this->redirectToRoute('app_utente_index', [], Response::HTTP_SEE_OTHER);
    }
}
