<?php

namespace App\Entity;

use App\Repository\PrenotazioneRepository;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrenotazioneRepository::class)]
#[ORM\Table(name: 'prenotazioni')]
class Prenotazione
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?DateTimeInterface $dataPrenotazione = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?DateTimeInterface $dataInizioPrenotazione = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?DateTimeInterface $dataFinePrenotazione = null;

    #[ORM\Column]
    private ?int $stato = null;

    #[ORM\ManyToOne(inversedBy: 'prenotazioni')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utente $utente = null;

    #[ORM\ManyToOne(inversedBy: 'prenotazioni')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Postazione $postazione = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDataPrenotazione(): ?DateTimeInterface
    {
        return $this->dataPrenotazione;
    }

    public function setDataPrenotazione(DateTimeInterface $dataPrenotazione): self
    {
        $this->dataPrenotazione = $dataPrenotazione;

        return $this;
    }

    public function getDataInizioPrenotazione(): ?DateTimeInterface
    {
        return $this->dataInizioPrenotazione;
    }

    public function setDataInizioPrenotazione(DateTimeInterface $dataInizioPrenotazione): self
    {
        $this->dataInizioPrenotazione = $dataInizioPrenotazione;

        return $this;
    }

    public function getDataFinePrenotazione(): ?DateTimeInterface
    {
        return $this->dataFinePrenotazione;
    }

    public function setDataFinePrenotazione(DateTimeInterface $dataFinePrenotazione): self
    {
        $this->dataFinePrenotazione = $dataFinePrenotazione;

        return $this;
    }

    public function getStato(): ?int
    {
        return $this->stato;
    }

    public function setStato(int $stato): self
    {
        $this->stato = $stato;

        return $this;
    }

    public function getUtente(): ?Utente
    {
        return $this->utente;
    }

    public function setUtente(?Utente $utente): self
    {
        $this->utente = $utente;

        return $this;
    }

    public function getPostazione(): ?Postazione
    {
        return $this->postazione;
    }

    public function setPostazione(?Postazione $postazione): self
    {
        $this->postazione = $postazione;

        return $this;
    }
}
