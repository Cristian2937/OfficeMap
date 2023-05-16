<?php

namespace App\Entity\Model;

use App\Entity\Utente;
use App\Enum\StatoWorkflow;
use App\Repository\UtenteRepository;

class UtenteModel //extends UtenteRepository
{

    private ?int $id;
    private ?string $nome;
    private ?string $cognome;
    private ?string $email;

    private ?string $ragioneSociale;

    private ?string $descrizione;
    private ?string $stato;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getNome(): ?string
    {
        return $this->nome;
    }

    /**
     * @param string|null $nome
     */
    public function setNome(?string $nome): void
    {
        $this->nome = $nome;
    }

    /**
     * @return string|null
     */
    public function getCognome(): ?string
    {
        return $this->cognome;
    }

    /**
     * @param string|null $cognome
     */
    public function setCognome(?string $cognome): void
    {
        $this->cognome = $cognome;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getRagioneSociale(): ?string
    {
        return $this->ragioneSociale;
    }

    /**
     * @param string|null $ragioneSociale
     */
    public function setRagioneSociale(?string $ragioneSociale): void
    {
        $this->ragioneSociale = $ragioneSociale;
    }

    /**
     * @return string|null
     */
    public function getDescrizione(): ?string
    {
        return $this->descrizione;
    }

    /**
     * @param string|null $descrizione
     */
    public function setDescrizione(?string $descrizione): void
    {
        $this->descrizione = $descrizione;
    }

    /**
     * @return string|null
     */
    public function getStato(): ?string
    {
        return $this->stato;
    }

    /**
     * @param string|null $stato
     */
    public function setStato(?string $stato): void
    {
        $this->stato = $stato;
    }

    public function setRagSoc(Utente $utente): void
    {
        if($utente->getPersonaGiuridica() == null){
            $this->ragioneSociale = "null";
        } else{
            $this->ragioneSociale = $utente->getPersonaGiuridica()->getRagioneSociale();
        }
    }


    public function __construct(Utente $utente)
    {
        $this->setId($utente->getId());
        //$this->id = ;
        $this->setNome($utente->getPersoneFisiche()->getNome());
        //$this->nome = ;
        $this->setCognome($utente->getPersoneFisiche()->getCognome());
        //$this->cognome = ;
        $this->setEmail($utente->getEmail());
        //$this->email = ;
        $this->setRagSoc($utente);
        //$this->ragioneSociale = ;
        $this->setDescrizione($utente->getRuolo()->getDescrizioneRuolo());
        //$this->descrizione = ;
        $this->setStato(StatoWorkflow::from($utente->getStato())->name);
        //$this->stato =  ;
    }

}