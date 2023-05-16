<?php

namespace App\DataFixtures;

use App\Entity\PersonaFisica;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class PersonaFisicaFixtures extends Fixture implements FixtureGroupInterface
{
    const PRIMA_PERSONA_FISICA = 'Cristian';
    const SECONDA_PERSONA_FISICA = 'Giacomo';
    const TERZA_PERSONA_FISICA = 'Luca';
    const  QUARTA_PERSONA_FISICA = 'Andrea';
    public function load(ObjectManager $manager)
    {

        $data = new DateTime();

        $persona1 = new PersonaFisica();
        $persona1->setNome('Cristian') // UTENTE ADMIN
            ->setCognome('Pignatiello')
            ->setCodiceFiscale('PGNCST00R28H501I')
            ->setTelefono('+393240842651')
            ->setDataNascita(($data->setDate(2000, 10, 28)))
        ->setLuogoNascita('Roma');
        $manager->persist($persona1);

        $this->addReference(self::PRIMA_PERSONA_FISICA,$persona1);

        $persona2 = new PersonaFisica();
        $persona2->setNome('Giacomo') // UTENTE GUEST
        ->setCognome('Catanzaro')
            ->setCodiceFiscale('NTVD4431H501M')
            ->setTelefono('+39111223344')
            ->setDataNascita(($data->setDate(1998, 6, 12)))
            ->setLuogoNascita('Lecce');
        $manager->persist($persona2);

        $this->addReference(self::SECONDA_PERSONA_FISICA,$persona2);

        $persona3 = new PersonaFisica();
        $persona3->setNome('Luca') // UTENTE GUEST
        ->setCognome('Oliva')
            ->setCodiceFiscale('LCLV28HD82R501L')
            ->setTelefono('+3912344321')
            ->setDataNascita(($data->setDate(1998, 6, 12)))
            ->setLuogoNascita('Lecce');
        $manager->persist($persona3);

        $this->addReference(self::TERZA_PERSONA_FISICA,$persona3);

        $persona4 = new PersonaFisica();
        $persona4->setNome('Andrea') // UTENTE GUEST
        ->setCognome('Filesi')
            ->setCodiceFiscale('NDRFSI97R501U')
            ->setTelefono('+39556677889')
            ->setDataNascita(($data->setDate(1998, 6, 12)))
            ->setLuogoNascita('Lecce');
        $manager->persist($persona4);
        $this->addReference(self::QUARTA_PERSONA_FISICA,$persona4);

        //IL flush VA UTILIZZATO COME ULTIMO COMANDO
        $manager->flush();

    }


    public static function getGroups(): array
    {

        return ['dev','sedeProva'];
    }



}