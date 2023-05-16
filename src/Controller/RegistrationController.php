<?php

namespace App\Controller;

use App\Entity\PersonaFisica;
use App\Entity\Ruolo;
use App\Entity\Utente;
use App\Enum\StatoWorkflow;
use App\Form\PersonaFisicaFormType;
use App\Form\RegistrationFormType;
use App\Repository\RuoloRepository;
use App\Security\AppAuthenticator;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
    /**
     * @throws ORMException
     */
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, AppAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {


        $date = new DateTime();
        $user = new Utente();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        $personaFisica = new PersonaFisica();


        $formPersonaFisica = $this->createForm(PersonaFisicaFormType::class,$personaFisica);
        $formPersonaFisica->handleRequest($request);
        $query = $entityManager->createQueryBuilder();


        if ($form->isSubmitted() && $form->isValid() && $formPersonaFisica->isSubmitted() && $formPersonaFisica->isValid()) {

            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            )
            ->setDataUltimoAggiornamento($date)
            ->setPersoneFisiche($personaFisica)
            ->setRuolo($entityManager->getReference('App\Entity\Ruolo',153))
            ->setStato(StatoWorkflow::ATTESA_DI_APPROVAZIONE->value);

            $entityManager->persist($personaFisica);
            $entityManager->persist($user);

            $entityManager->flush();
            // do anything else you need here, like send an email

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'personaFisicaForm' => $formPersonaFisica->createView(),

        ]);
    }
}
