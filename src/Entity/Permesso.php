<?php

namespace App\Entity;

use App\Repository\PermessoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PermessoRepository::class)]
#[ORM\Table(name: 'permessi')]
class Permesso
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(options: ['defaults'=>false])]
    private ?bool $gestioneUtente = false;

    #[ORM\Column(options: ['defaults'=>false])]
    private ?bool $gestionePrenotazione = false;

    #[ORM\Column(options: ['defaults'=>false])]
    private ?bool $gestioneStanze = false;

    #[ORM\Column(options: ['defaults'=>false])]
    private ?bool $invioPrenotazione = false;

    #[ORM\OneToOne(inversedBy: 'permessi', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ruolo $ruolo = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function isGestioneUtente(): ?bool
    {
        return $this->gestioneUtente;
    }

    public function setGestioneUtente(bool $gestioneUtente): self
    {
        $this->gestioneUtente = $gestioneUtente;

        return $this;
    }

    public function isGestionePrenotazione(): ?bool
    {
        return $this->gestionePrenotazione;
    }

    public function setGestionePrenotazione(bool $gestionePrenotazione): self
    {
        $this->gestionePrenotazione = $gestionePrenotazione;

        return $this;
    }

    public function isGestioneStanze(): ?bool
    {
        return $this->gestioneStanze;
    }

    public function setGestioneStanze(bool $gestioneStanze): self
    {
        $this->gestioneStanze = $gestioneStanze;

        return $this;
    }

    public function isInvioPrenotazione(): ?bool
    {
        return $this->invioPrenotazione;
    }

    public function setInvioPrenotazione(bool $invioPrenotazione): self
    {
        $this->invioPrenotazione = $invioPrenotazione;

        return $this;
    }

    public function getRuolo(): ?Ruolo
    {
        return $this->ruolo;
    }

    public function setRuolo(Ruolo $ruolo): self
    {
        $this->ruolo = $ruolo;

        return $this;
    }


}
