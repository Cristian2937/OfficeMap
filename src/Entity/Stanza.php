<?php

namespace App\Entity;

use App\Repository\StanzaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StanzaRepository::class)]
#[ORM\Table(name: 'stanze')]
class Stanza
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $piano = null;

    #[ORM\Column(length: 255)]
    private ?string $nomeStanza = null;

    #[ORM\ManyToOne(inversedBy: 'stanze')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sede $sede = null;

    #[ORM\OneToMany(mappedBy: 'stanza', targetEntity: Postazione::class, orphanRemoval: true)]
    private Collection $postazioni;

    public function __construct()
    {
        $this->postazioni = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPiano(): ?int
    {
        return $this->piano;
    }

    public function setPiano(int $piano): self
    {
        $this->piano = $piano;

        return $this;
    }

    public function getNomeStanza(): ?string
    {
        return $this->nomeStanza;
    }

    public function setNomeStanza(string $nomeStanza): self
    {
        $this->nomeStanza = $nomeStanza;

        return $this;
    }

    public function getSede(): ?Sede
    {
        return $this->sede;
    }

    public function setSede(?Sede $sede): self
    {
        $this->sede = $sede;

        return $this;
    }

    /**
     * @return Collection<int, Postazione>
     */
    public function getPostazioni(): Collection
    {
        return $this->postazioni;
    }

    public function addPostazioni(Postazione $postazioni): self
    {
        if (!$this->postazioni->contains($postazioni)) {
            $this->postazioni->add($postazioni);
            $postazioni->setStanza($this);
        }

        return $this;
    }

    public function removePostazioni(Postazione $postazioni): self
    {
        if ($this->postazioni->removeElement($postazioni)) {
            // set the owning side to null (unless already changed)
            if ($postazioni->getStanza() === $this) {
                $postazioni->setStanza(null);
            }
        }

        return $this;
    }
}
