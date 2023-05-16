<?php

namespace App\DataFixtures;

use App\Entity\Postazione;
use App\Entity\Prenotazione;
use App\Entity\Utente;
use App\Enum\StatoWorkflow;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PrenotazioneFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $data = new DateTime();
        $utente = (fn($obj): Utente => $obj)($this->getReference(UtenteFixtures::PRIMO_UTENTE));
        $postazione = (fn($obj): Postazione => $obj)($this->getReference(PostazioneFixtures::PRIMA_POSTAZIONE));

        $prenotazione = new Prenotazione();
        $prenotazione->setStato(StatoWorkflow::ATTESA->value)
        ->setDataPrenotazione(($data))
        ->setDataInizioPrenotazione(($data->setDate(2023,4,3)))
        ->setDataFinePrenotazione(($data->setDate(2023,4,3)))
        ->setUtente($utente)
        ->setPostazione($postazione);

        $manager->persist($prenotazione);

        $manager->flush();
    }
    public function getDependencies():array
    {
        return[
            UtenteFixtures::class,
            PostazioneFixtures::class
        ];
    }

    public static function getGroups(): array
    {
        return ['dev'];
    }


}