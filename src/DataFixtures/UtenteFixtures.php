<?php

namespace App\DataFixtures;

use App\Entity\PersonaFisica;
use App\Entity\PersonaGiuridica;
use App\Entity\Ruolo;
use App\Entity\Utente;
use App\Enum\StatoWorkflow;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\VarDumper\Cloner\Data;

class UtenteFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    const PRIMO_UTENTE = 'utente1';
    const SECONDO_UTENTE = 'utente2';
    const TERZO_UTENTE = 'utente3';
    const QUARTO_UTENTE = 'utente4';

    public function load(ObjectManager $manager)
    {
        $date = new DateTime();

        $admin = (fn($obj): Ruolo => $obj)($this->getReference(RuoloFixtures::ROLE_REFERENCE_ADMIN));
        $primaPersonaFisica = (fn($obj): PersonaFisica => $obj)($this->getReference(PersonaFisicaFixtures::PRIMA_PERSONA_FISICA));
        $personaGiuridica = (fn($obj): PersonaGiuridica => $obj)($this->getReference(PersonaGiuridicaFixtures::PRIMA_PERSONA_GIURIDICA));

        $utenteAdmin = new Utente();
        $utenteAdmin->setEmail('cristian.pignatiello@linksmt.it')
            ->setPassword('$2a$04$jLVRan3ZZbm0oyaB9e5.UeHl7tI99Q5wxBonTl92yQDEPVF/1VKwC')
            ->setDataUltimoAggiornamento($date)
            ->setPersoneFisiche($primaPersonaFisica)
            ->setPersonaGiuridica($personaGiuridica)
            ->setRuolo($admin)
            ->setStato(StatoWorkflow::ATTIVO->value);

        $manager->persist($utenteAdmin);

        $this->addReference(self::PRIMO_UTENTE, $utenteAdmin);

        $coord = (fn($obj): Ruolo => $obj)($this->getReference(RuoloFixtures::ROLE_REFERENCE_COORD));
        $secondaPersonaFisica = (fn($obj): PersonaFisica => $obj)($this->getReference(PersonaFisicaFixtures::SECONDA_PERSONA_FISICA));
        //$personaGiuridica2 = (fn($obj):PersonaGiuridica => $obj)($this->getReference(PersonaGiuridicaFixtures::PRIMA_PERSONA_GIURIDICA));

        $utenteCoord = new Utente();
        $utenteCoord->setEmail('giacomo.catanzaro@linksmt.it')
            ->setPassword('$2y$04$QZphf40twPYYM6JXP0T5b.ZCVJBW3uIcDXhhflRTOWI4Aw2fVQiVm')
            ->setDataUltimoAggiornamento($date)
            ->setPersoneFisiche($secondaPersonaFisica)
            ->setPersonaGiuridica($personaGiuridica)
            ->setRuolo($coord)
            ->setStato(StatoWorkflow::ATTIVO->value);

        $manager->persist($utenteCoord);
        $this->addReference(self::SECONDO_UTENTE, $utenteCoord);

        $user = (fn($obj): Ruolo => $obj)($this->getReference(RuoloFixtures::ROLE_REFERENCE_USER));
        $terzaPersonaFisica = (fn($obj): PersonaFisica => $obj)($this->getReference(PersonaFisicaFixtures::TERZA_PERSONA_FISICA));
        //$personaGiuridica3 = (fn($obj):PersonaGiuridica => $obj)($this->getReference(PersonaGiuridicaFixtures::PRIMA_PERSONA_GIURIDICA));

        $utenteUser = new Utente();
        $utenteUser->setEmail('luca.oliva@linksmt.it')
            ->setPassword('$2y$04$QZphf40twPYYM6JXP0T5b.ZCVJBW3uIcDXhhflRTOWI4Aw2fVQiVm')
            ->setDataUltimoAggiornamento($date)
            ->setPersoneFisiche($terzaPersonaFisica)
            ->setPersonaGiuridica($personaGiuridica)
            ->setRuolo($user)
        ->setStato(StatoWorkflow::ATTIVO->value);

        $manager->persist($utenteUser);
        $this->addReference(self::TERZO_UTENTE, $utenteUser);

        $guest = (fn($obj): Ruolo => $obj)($this->getReference(RuoloFixtures::ROLE_REFERENCE_GUEST));
        $quartaPersonaFisica = (fn($obj): PersonaFisica => $obj)($this->getReference(PersonaFisicaFixtures::QUARTA_PERSONA_FISICA));
        //$personaGiuridica4 = (fn($obj):PersonaGiuridica => $obj)($this->getReference(PersonaGiuridicaFixtures::PRIMA_PERSONA_GIURIDICA));

        $utenteGuest = new Utente();
        $utenteGuest->setEmail('andrea.filesi@linksmt.it')
            ->setPassword('$2y$04$QZphf40twPYYM6JXP0T5b.ZCVJBW3uIcDXhhflRTOWI4Aw2fVQiVm')
            ->setDataUltimoAggiornamento($date)
            ->setPersoneFisiche($quartaPersonaFisica)
            ->setPersonaGiuridica($personaGiuridica)
            ->setRuolo($guest)
            ->setStato(StatoWorkflow::ATTIVO->value);

        $manager->persist($utenteGuest);
        $this->addReference(self::QUARTO_UTENTE, $utenteGuest);

        $manager->flush();
    }

    public function getDependencies(): array
    {

        return [PersonaFisicaFixtures::class,
            PersonaGiuridicaFixtures::class,
            RuoloFixtures::class];
    }

    public static function getGroups(): array
    {

        return ['dev', 'sedeProva'];
    }


}