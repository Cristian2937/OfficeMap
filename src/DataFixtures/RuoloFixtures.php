<?php

namespace App\DataFixtures;

use App\Entity\Permesso;
use App\Entity\Ruolo;
use App\Enum\StatoWorkflow;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class RuoloFixtures extends Fixture implements FixtureGroupInterface
{
    const ROLE_REFERENCE_ADMIN = 'ruolo_admin';
    const ROLE_REFERENCE_COORD = 'ruolo_coordinatore';
    const ROLE_REFERENCE_USER = 'ruolo_user';
    const ROLE_REFERENCE_GUEST = 'ruolo_guest';


    public function load(ObjectManager $manager)
    {
        /*$permesso = (fn($obj):Permesso => $obj)($this->getReference(PermessoFixtures::PERMESSO_ADMIN));*/
        // TODO: Implement load() method.
        $roleAdmin = new Ruolo();
        $roleAdmin->setDescrizioneRuolo("amministratore")
            ->setCodice('ROLE_ADMIN')
            ->setDefaultRoute('home');
        $manager->persist($roleAdmin);
        $this->addReference(self::ROLE_REFERENCE_ADMIN,$roleAdmin);

        $roleCoord = new Ruolo();
        $roleCoord->setDescrizioneRuolo('coordinatore')
        ->setCodice('ROLE_COORD')
        ->setDefaultRoute('home');
        $manager->persist($roleCoord);
        $this->addReference(self::ROLE_REFERENCE_COORD,$roleCoord);

        $roleUser = new Ruolo();
        $roleUser->setDescrizioneRuolo('user')
        ->setCodice('ROLE_USER')
            ->setDefaultRoute('home');
        $manager->persist($roleUser);
        $this->addReference(self::ROLE_REFERENCE_USER,$roleUser);

        $roleGuest = new Ruolo();
        $roleGuest->setDescrizioneRuolo('guest')
        ->setCodice('ROLE_GUEST')
        ->setDefaultRoute('home');
        $manager->persist($roleGuest);
        $this->addReference(self::ROLE_REFERENCE_GUEST,$roleGuest);


        $manager->flush();
    }
    public static function getGroups():array
    {
    // TODO: Implement getGroups() method.
        return ['dev','typological','IDM','sedeProva'];
    }
}