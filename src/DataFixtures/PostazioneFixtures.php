<?php

namespace App\DataFixtures;

use App\Entity\Postazione;
use App\Entity\Stanza;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PostazioneFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    const PRIMA_POSTAZIONE = 'primaPostazione';
    public function load(ObjectManager $manager)
    {
        $primaStanza = (fn($obj):Stanza => $obj)($this->getReference(StanzaFixtures::STANZA_PRIMA));
        $postazione = new Postazione();
        $postazione->setKitPostazione(true)
        ->setStanza($primaStanza);

        $manager->persist($postazione);

        $this->addReference(self::PRIMA_POSTAZIONE,$postazione);

        $manager->flush();
    }

    public function getDependencies():array
    {
        return [StanzaFixtures::class];
    }

    public static function getGroups(): array
    {
        return ['dev','sedeProva'];
    }


}