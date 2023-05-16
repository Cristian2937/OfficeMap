<?php

namespace App\Entity;

use App\Repository\PostazioneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostazioneRepository::class)]
#[ORM\Table(name: 'postazioni')]
class Postazione
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $kitPostazione = null;



    #[ORM\ManyToOne(inversedBy: 'postazioni')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Stanza $stanza = null;

    #[ORM\OneToMany(mappedBy: 'postazione', targetEntity: Prenotazione::class, orphanRemoval: true)]
    private Collection $prenotazioni;

    public function __construct()
    {
        $this->prenotazioni = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isKitPostazione(): ?bool
    {
        return $this->kitPostazione;
    }

    public function setKitPostazione(bool $kitPostazione): self
    {
        $this->kitPostazione = $kitPostazione;

        return $this;
    }


    public function getStanza(): ?Stanza
    {
        return $this->stanza;
    }

    public function setStanza(?Stanza $stanza): self
    {
        $this->stanza = $stanza;

        return $this;
    }

    /**
     * @return Collection<int, Prenotazione>
     */
    public function getPrenotazioni(): Collection
    {
        return $this->prenotazioni;
    }

    public function addPrenotazioni(Prenotazione $prenotazioni): self
    {
        if (!$this->prenotazioni->contains($prenotazioni)) {
            $this->prenotazioni->add($prenotazioni);
            $prenotazioni->setPostazione($this);
        }

        return $this;
    }

    public function removePrenotazioni(Prenotazione $prenotazioni): self
    {
        if ($this->prenotazioni->removeElement($prenotazioni)) {
            // set the owning side to null (unless already changed)
            if ($prenotazioni->getPostazione() === $this) {
                $prenotazioni->setPostazione(null);
            }
        }

        return $this;
    }
}
