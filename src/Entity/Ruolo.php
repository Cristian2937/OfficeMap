<?php

namespace App\Entity;

use App\Repository\RuoloRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RuoloRepository::class)]
#[ORM\Table(name: 'ruoli')]
class Ruolo
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $descrizioneRuolo = null;


    #[ORM\Column(length: 255)]
    private ?string $codice = null;



    #[ORM\Column(length: 255)]
    private ?string $defaultRoute = null;



    #[ORM\OneToOne(mappedBy: 'ruolo', cascade: ['persist', 'remove'])]
    private ?Permesso $permessi = null;

    #[ORM\OneToMany(mappedBy: 'ruolo', targetEntity: Utente::class, orphanRemoval: true)]
    private Collection $utenti;

    public function __construct()
    {
        $this->utenti = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescrizioneRuolo(): ?string
    {
        return $this->descrizioneRuolo;
    }

    public function setDescrizioneRuolo(string $descrizioneRuolo): self
    {
        $this->descrizioneRuolo = $descrizioneRuolo;

        return $this;
    }

    public function getCodice(): ?string
    {
        return $this->codice;
    }

    public function setCodice(string $codice): self
    {
        $this->codice = $codice;

        return $this;
    }



    public function getDefaultRoute(): ?string
    {
        return $this->defaultRoute;
    }

    public function setDefaultRoute(string $defaultRoute): self
    {
        $this->defaultRoute = $defaultRoute;

        return $this;
    }





    public function getPermessi(): ?Permesso
    {
        return $this->permessi;
    }

    public function setPermessi(Permesso $permessi): self
    {
        // set the owning side of the relation if necessary
        if ($permessi->getRuolo() !== $this) {
            $permessi->setRuolo($this);
        }

        $this->permessi = $permessi;

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
            $utenti->setRuolo($this);
        }

        return $this;
    }

    public function removeUtenti(Utente $utenti): self
    {
        if ($this->utenti->removeElement($utenti)) {
            // set the owning side to null (unless already changed)
            if ($utenti->getRuolo() === $this) {
                $utenti->setRuolo(null);
            }
        }

        return $this;
    }

    public function __toString():string
    {
        return $this->getDescrizioneRuolo();
    }
}
