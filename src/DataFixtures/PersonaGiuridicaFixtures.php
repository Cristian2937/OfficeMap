<?php

namespace App\DataFixtures;

use App\Entity\PersonaGiuridica;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class PersonaGiuridicaFixtures extends Fixture implements FixtureGroupInterface
{
    const PRIMA_PERSONA_GIURIDICA = 'primaPersonaGiuridica';
    public function load(ObjectManager $manager)
    {

        $personaGiuridica = new PersonaGiuridica();
        $personaGiuridica->setRagioneSociale('snc')
        ->setPartitaIva('86334519757')
            ->setTelefono('+39111222333444')
            ->setMailAziendale("links@legalmail.it")
        ->setNomeAzienda("Links");

        $manager->persist($personaGiuridica);
        $this->addReference(self::PRIMA_PERSONA_GIURIDICA,$personaGiuridica);

        $manager->flush();
    }


    public static function getGroups(): array
    {

        return ['dev','sedeProva'];
    }


}