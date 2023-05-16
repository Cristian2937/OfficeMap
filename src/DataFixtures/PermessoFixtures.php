<?php

namespace App\DataFixtures;

use App\Entity\Permesso;
use App\Entity\Ruolo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PermessoFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{

    const PERMESSO_ADMIN = 'admin';
    const PERMESSO_COORD = 'coordinatore';
    const PERMESSO_USER = 'utente';
    const PERMESSO_GUEST = 'utente_guest';

    public function load(ObjectManager $manager)
    {

        $admin = (fn($obj): Ruolo => $obj)($this->getReference(RuoloFixtures::ROLE_REFERENCE_ADMIN));
        $permessoAdmin = new Permesso();
        $permessoAdmin->setGestioneUtente(true)
            ->setGestionePrenotazione(true)
            ->setGestioneStanze(true)
            ->setInvioPrenotazione(true)
            ->setRuolo($admin);

        $manager->persist($permessoAdmin);


        $coord = (fn($obj): Ruolo=> $obj)($this->getReference(RuoloFixtures::ROLE_REFERENCE_COORD));
        $permessoCoord = new Permesso();
        $permessoCoord->setGestioneUtente(false)
        ->setGestioneStanze(false)
        ->setGestionePrenotazione(true)
            ->setInvioPrenotazione(true)
        ->setRuolo($coord);

        $user = (fn($obj): Ruolo => $obj)($this->getReference(RuoloFixtures::ROLE_REFERENCE_USER));
        $permessoUser = new Permesso();
        $permessoUser->setGestioneUtente(false)
            ->setGestioneStanze(false)
            ->setGestionePrenotazione(false)
            ->setInvioPrenotazione(true)
            ->setRuolo($user);

        $guest = (fn($obj): Ruolo =>$obj)($this->getReference(RuoloFixtures::ROLE_REFERENCE_GUEST));
        $permessoGuest = new Permesso();
        $permessoGuest->setInvioPrenotazione(true);

        $manager->flush();

    }

    public function getDependencies(): array
    {

        return [RuoloFixtures::class];
    }

    public static function getGroups(): array
    {

        return ['dev','sedeProva'];
    }
}