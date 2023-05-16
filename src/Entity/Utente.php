<?php

namespace App\Entity;

use App\Repository\UtenteRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UtenteRepository::class)]
#[ORM\Table(name: 'utenti')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Utente implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255,unique: true)]
    #[Assert\NotBlank()]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    /*#[Assert\NotBlank()]*/
    private ?string $password = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $dataUltimoAggiornamento = null;


    #[ORM\ManyToOne(inversedBy: 'utenti')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PersonaFisica $personaFisica = null;


    #[ORM\ManyToOne(inversedBy: 'utenti')]
    #[ORM\JoinColumn(nullable: true)]
    private ?PersonaGiuridica $personaGiuridica = null;

    #[ORM\OneToMany(mappedBy: 'utente', targetEntity: Prenotazione::class, orphanRemoval: true)]
    private Collection $prenotazioni;

    #[ORM\ManyToOne(inversedBy: 'utenti')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ruolo $ruolo = null;

    #[ORM\Column]
    private ?int $stato = null;





    public function __construct()
    {
        $this->prenotazioni = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return (string)$this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }



    public function getDataUltimoAggiornamento(): ?DateTimeInterface
    {
        return $this->dataUltimoAggiornamento;
    }

    public function setDataUltimoAggiornamento(DateTimeInterface $dataUltimoAggiornamento): self
    {
        $this->dataUltimoAggiornamento = $dataUltimoAggiornamento;

        return $this;
    }

    public function getPersoneFisiche(): ?personaFisica
    {
        return $this->personaFisica;
    }

    public function setPersoneFisiche(?personaFisica $personeFisiche): self
    {
        $this->personaFisica = $personeFisiche;

        return $this;
    }



    public function getPersonaGiuridica(): ?PersonaGiuridica
    {
        return $this->personaGiuridica;
    }

    public function setPersonaGiuridica(?PersonaGiuridica $personaGiuridica): self
    {
        $this->personaGiuridica = $personaGiuridica;

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
            $prenotazioni->setUtente($this);
        }

        return $this;
    }

    public function removePrenotazioni(Prenotazione $prenotazioni): self
    {
        if ($this->prenotazioni->removeElement($prenotazioni)) {
            // set the owning side to null (unless already changed)
            if ($prenotazioni->getUtente() === $this) {
                $prenotazioni->setUtente(null);
            }
        }

        return $this;
    }

    public function getRuolo(): ?Ruolo
    {
        return $this->ruolo;
    }

    public function setRuolo(?Ruolo $ruolo): self
    {
        $this->ruolo = $ruolo;

        return $this;
    }

    public function __toString():string
    {
        return '('. $this->getRuolo() .') '. $this->getPersoneFisiche(). ' | '. $this->getPersonaGiuridica();
    }


    public function getRoles(): array
    {
        // TODO: Implement getRoles() method.
        $roles[] = $this->getRuolo()->getCodice();
        return array_unique($roles);
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return (string)$this->email;
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
}
