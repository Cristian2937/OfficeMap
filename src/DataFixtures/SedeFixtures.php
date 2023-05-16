<?php

namespace App\DataFixtures;

use App\Entity\PersonaGiuridica;
use App\Entity\Sede;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SedeFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    const SEDE_PRIMA = 'Links';
    public function load(ObjectManager $manager)
    {

        $personaGiuridica = (fn($obj): PersonaGiuridica=> $obj)($this->getReference(PersonaGiuridicaFixtures::PRIMA_PERSONA_GIURIDICA));

        $sede = new Sede();
        $sede->setIndirizzo('Via Giovanni Battista Morgagni')
        ->setCivico('30/E')
        ->setCitta('Roma')
        ->setCap('00161')
        ->setProvincia('RM')
        ->setSedeOperativa(false)
        ->setTelefonoSede('+3922233344455')
        ->setPersoneGiuridiche($personaGiuridica);

        $manager->persist($sede);
        $this->addReference(self::SEDE_PRIMA,$sede);

        $manager->flush();

    }
    public static function getGroups(): array
    {

        return ['dev','sedeProva'];
    }


    public function getDependencies():array
    {

        return [PersonaGiuridicaFixtures::class];
    }
}