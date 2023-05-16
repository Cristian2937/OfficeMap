<?php

namespace App\Controller;

use App\Entity\PersonaGiuridica;
use App\Form\PersonaGiuridicaType;
use App\Repository\PersonaGiuridicaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/persona/giuridica')]
class PersonaGiuridicaController extends AbstractController
{
    #[Route('/', name: 'app_persona_giuridica_index', methods: ['GET'])]
    public function index(PersonaGiuridicaRepository $personaGiuridicaRepository): Response
    {



        return $this->render('persona_giuridica/index.html.twig', [
            'persona_giuridicas' => $personaGiuridicaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_persona_giuridica_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PersonaGiuridicaRepository $personaGiuridicaRepository): Response
    {
        $personaGiuridica = new PersonaGiuridica();
        $form = $this->createForm(PersonaGiuridicaType::class, $personaGiuridica);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $personaGiuridicaRepository->save($personaGiuridica, true);

            return $this->redirectToRoute('app_persona_giuridica_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('persona_giuridica/new.html.twig', [
            'persona_giuridica' => $personaGiuridica,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_persona_giuridica_show', methods: ['GET'])]
    public function show(PersonaGiuridica $personaGiuridica): Response
    {
        return $this->render('persona_giuridica/show.html.twig', [
            'persona_giuridica' => $personaGiuridica,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_persona_giuridica_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PersonaGiuridica $personaGiuridica, PersonaGiuridicaRepository $personaGiuridicaRepository): Response
    {
        $form = $this->createForm(PersonaGiuridicaType::class, $personaGiuridica);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $personaGiuridicaRepository->save($personaGiuridica, true);

            return $this->redirectToRoute('app_persona_giuridica_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('persona_giuridica/edit.html.twig', [
            'persona_giuridica' => $personaGiuridica,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_persona_giuridica_delete', methods: ['POST'])]
    public function delete(Request $request, PersonaGiuridica $personaGiuridica, PersonaGiuridicaRepository $personaGiuridicaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$personaGiuridica->getId(), $request->request->get('_token'))) {
            $personaGiuridicaRepository->remove($personaGiuridica, true);
        }

        return $this->redirectToRoute('app_persona_giuridica_index', [], Response::HTTP_SEE_OTHER);
    }
}
