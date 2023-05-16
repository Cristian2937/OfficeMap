<?php

namespace App\Entity;

use App\Repository\PersonaGiuridicaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonaGiuridicaRepository::class)]
#[ORM\Table(name: 'persone_giuridiche')]
class PersonaGiuridica
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 255)]
    private ?string $ragioneSociale = null;

    #[ORM\Column(length: 16,unique: true)]
    private ?string $partitaIva = null;

    #[ORM\Column(length: 20)]
    private ?string $telefono = null;

    #[ORM\Column(length: 255)]
    private ?string $mailAziendale = null;
    #[ORM\Column(length: 255)]
    private ?string $nomeAzienda = null;
    #[ORM\OneToMany(mappedBy: 'personaGiuridica', targetEntity: Sede::class, orphanRemoval: true)]
    private Collection $sedi;

    #[ORM\OneToMany(mappedBy: 'personaGiuridica', targetEntity: Utente::class, orphanRemoval: true)]
    private Collection $utenti;



    public function __construct()
    {
        $this->sedi = new ArrayCollection();
        $this->utenti = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getRagioneSociale(): ?string
    {
        return $this->ragioneSociale;
    }

    public function setRagioneSociale(string $ragioneSociale): self
    {
        $this->ragioneSociale = $ragioneSociale;

        return $this;
    }

    public function getPartitaIva(): ?string
    {
        return $this->partitaIva;
    }

    public function setPartitaIva(string $partitaIva): self
    {
        $this->partitaIva = $partitaIva;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getMailAziendale(): ?string
    {
        return $this->mailAziendale;
    }

    public function setMailAziendale(string $mailAziendale): self
    {
        $this->mailAziendale = $mailAziendale;

        return $this;
    }

    /**
     * @return Collection<int, Sede>
     */
    public function getSedi(): Collection
    {
        return $this->sedi;
    }

    public function addSedi(Sede $sedi): self
    {
        if (!$this->sedi->contains($sedi)) {
            $this->sedi->add($sedi);
            $sedi->setPersoneGiuridiche($this);
        }

        return $this;
    }

    public function removeSedi(Sede $sedi): self
    {
        if ($this->sedi->removeElement($sedi)) {
            // set the owning side to null (unless already changed)
            if ($sedi->getPersoneGiuridiche() === $this) {
                $sedi->setPersoneGiuridiche(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Utente>
     */
    public function getUtenti(): Collection
    {
        return $this->utenti;
    }

    public function addUtenti(Utente $utenti): self
    {
        if (!$this->utenti->contains($utenti)) {
            $this->utenti->add($utenti);
            $utenti->setPersonaGiuridica($this);
        }

        return $this;
    }

    public function removeUtenti(Utente $utenti): self
    {
        if ($this->utenti->removeElement($utenti)) {
            // set the owning side to null (unless already changed)
            if ($utenti->getPersonaGiuridica() === $this) {
                $utenti->setPersonaGiuridica(null);
            }
        }

        return $this;
    }

    public function getNomeAzienda(): ?string
    {
        return $this->nomeAzienda;
    }

    public function setNomeAzienda(string $nomeAzienda): self
    {
        $this->nomeAzienda = $nomeAzienda;

        return $this;
    }

    public function __toString():string
    {
        return $this->getRagioneSociale().'('.$this->getPartitaIva().')';
    }
}
