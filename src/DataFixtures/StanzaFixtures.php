<?php

namespace App\DataFixtures;

use App\Entity\Sede;
use App\Entity\Stanza;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class StanzaFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{

    const STANZA_PRIMA = 'stanza1';
    public function load(ObjectManager $manager)
    {
        $sede = (fn($obj): Sede =>$obj)($this->getReference(SedeFixtures::SEDE_PRIMA));
        $stanza1 = new Stanza();
        $stanza1->setPiano(5)
            ->setNomeStanza('stanza1')
        ->setSede($sede);

        $manager->persist($stanza1);

        $this->addReference(self::STANZA_PRIMA,$stanza1);

        $manager->flush();
    }

    public function getDependencies()
    {

        return [
          SedeFixtures::class
        ];
    }

    public static function getGroups():array
    {

        return ['dev','sedeProva'];
    }


}