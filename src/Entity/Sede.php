<?php

namespace App\Entity;

use App\Repository\SedeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SedeRepository::class)]
#[ORM\Table(name: 'sedi')]
class Sede
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $indirizzo = null;

    #[ORM\Column(length: 255)]
    private ?string $civico = null;

    #[ORM\Column(length: 255)]
    private ?string $citta = null;

    #[ORM\Column(length: 255)]
    private ?string $cap = null;

    #[ORM\Column(length: 4)]
    private ?string $provincia = null;

    #[ORM\Column]
    private ?bool $sedeOperativa = null;

    #[ORM\Column(length: 255)]
    private ?string $telefonoSede = null;

    #[ORM\ManyToOne(inversedBy: 'sedi')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PersonaGiuridica $personaGiuridica = null;

    #[ORM\OneToMany(mappedBy: 'sede', targetEntity: Stanza::class, orphanRemoval: true)]
    private Collection $stanze;

    public function __construct()
    {
        $this->stanze = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIndirizzo(): ?string
    {
        return $this->indirizzo;
    }

    public function setIndirizzo(string $indirizzo): self
    {
        $this->indirizzo = $indirizzo;

        return $this;
    }

    public function getCivico(): ?string
    {
        return $this->civico;
    }

    public function setCivico(string $civico): self
    {
        $this->civico = $civico;

        return $this;
    }

    public function getCitta(): ?string
    {
        return $this->citta;
    }

    public function setCitta(string $citta): self
    {
        $this->citta = $citta;

        return $this;
    }

    public function getCap(): ?string
    {
        return $this->cap;
    }

    public function setCap(string $cap): self
    {
        $this->cap = $cap;

        return $this;
    }

    public function getProvincia(): ?string
    {
        return $this->provincia;
    }

    public function setProvincia(string $provincia): self
    {
        $this->provincia = $provincia;

        return $this;
    }

    public function isSedeOperativa(): ?bool
    {
        return $this->sedeOperativa;
    }

    public function setSedeOperativa(bool $sedeOperativa): self
    {
        $this->sedeOperativa = $sedeOperativa;

        return $this;
    }

    public function getTelefonoSede(): ?string
    {
        return $this->telefonoSede;
    }

    public function setTelefonoSede(string $telefonoSede): self
    {
        $this->telefonoSede = $telefonoSede;

        return $this;
    }

    public function getPersoneGiuridiche(): ?personaGiuridica
    {
        return $this->personaGiuridica;
    }

    public function setPersoneGiuridiche(?personaGiuridica $personeGiuridiche): self
    {
        $this->personaGiuridica = $personeGiuridiche;

        return $this;
    }

    /**
     * @return Collection<int, Stanza>
     */
    public function getStanze(): Collection
    {
        return $this->stanze;
    }

    public function addStanze(Stanza $stanze): self
    {
        if (!$this->stanze->contains($stanze)) {
            $this->stanze->add($stanze);
            $stanze->setSede($this);
        }

        return $this;
    }

    public function removeStanze(Stanza $stanze): self
    {
        if ($this->stanze->removeElement($stanze)) {
            // set the owning side to null (unless already changed)
            if ($stanze->getSede() === $this) {
                $stanze->setSede(null);
            }
        }

        return $this;
    }
}
