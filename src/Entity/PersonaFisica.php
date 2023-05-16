<?php

namespace App\Entity;

use App\Repository\PersonaFisicaRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/*use App\Validator\Constraints as NewAssert;*/

#[ORM\Entity(repositoryClass: PersonaFisicaRepository::class)]
#[ORM\Table(name: 'persone_fisiche')]
class PersonaFisica
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private ?int $id = null;



    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    #[Assert\Length([
        'min'=> 2,
        'max'=> 15,
        'minMessage' =>'Il tuo nome deve contenere minimo {{ limit }} caratteri',
        'maxMessage' => 'Il tuo nome deve essere più lungo di {{ limit }} caratteri',
    ])]
    #[Assert\Regex([
        'pattern' => '/\d/',
        'match' => false,
        'message' => 'Non sono ammessi numeri per il nome',
    ])]
    private ?string $nome = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    #[Assert\Length([
        'min'=> 2,
        'max'=> 15,
        'minMessage' =>'Il tuo cognome deve contenere minimo {{ limit }} caratteri',
        'maxMessage' => 'Il tuo cognome deve essere più lungo di {{ limit }} caratteri',
    ])]
    #[Assert\Regex([
        'pattern' => '/\d/',
        'match' => false,
        'message' => 'Non sono ammessi numeri per il cognome',
    ])]
    private ?string $cognome = null;

    #[ORM\Column(length: 16,unique: true)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 16)]
    private ?string $codiceFiscale = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank()]
    #[Assert\Length([
        'max'=> 15,
        'maxMessage' => 'Il numero di telefono deve essere più lungo di {{ limit }} caratteri',
    ])]
    private ?string $telefono = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank()]
    private ?DateTimeInterface $dataNascita = null;

    #[ORM\Column(length: 255)]
    private ?string $luogoNascita = null;

    #[ORM\OneToMany(mappedBy: 'personaFisica', targetEntity: Utente::class, orphanRemoval: true)]
    private Collection $utenti;

    public function __construct()
    {
        $this->utenti = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getCognome(): ?string
    {
        return $this->cognome;
    }

    public function setCognome(string $cognome): self
    {
        $this->cognome = $cognome;

        return $this;
    }

    public function getCodiceFiscale(): ?string
    {
        return $this->codiceFiscale;
    }

    public function setCodiceFiscale(string $codiceFiscale): self
    {
        $this->codiceFiscale = $codiceFiscale;

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

    public function getDataNascita(): ?DateTimeInterface
    {
        return $this->dataNascita;
    }

    public function setDataNascita(DateTimeInterface $dataNascita): self
    {
        $this->dataNascita = $dataNascita;

        return $this;
    }

    public function getLuogoNascita(): ?string
    {
        return $this->luogoNascita;
    }

    public function setLuogoNascita(string $luogoNascita): self
    {
        $this->luogoNascita = $luogoNascita;

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
            $utenti->setPersoneFisiche($this);
        }

        return $this;
    }

    public function removeUtenti(Utente $utenti): self
    {
        if ($this->utenti->removeElement($utenti)) {
            // set the owning side to null (unless already changed)
            if ($utenti->getPersoneFisiche() === $this) {
                $utenti->setPersoneFisiche(null);
            }
        }

        return $this;
    }

    public function __toString():string
    {
        return $this->nome. $this->cognome;
    }


}
