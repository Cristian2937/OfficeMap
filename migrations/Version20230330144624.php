<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230330144624 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE permessi (id SERIAL NOT NULL, gestione_utente BOOLEAN NOT NULL, gestione_prenotazione BOOLEAN NOT NULL, gestione_stanze BOOLEAN NOT NULL, invio_prenotazione BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE personeGiuridiche (id SERIAL NOT NULL, ragione_sociale VARCHAR(255) NOT NULL, partita_iva VARCHAR(16) NOT NULL, telefono VARCHAR(20) NOT NULL, mail_aziendale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D31F5BBCE0B88091 ON personeGiuridiche (partita_iva)');
        $this->addSql('CREATE TABLE personefisiche (id SERIAL NOT NULL, nome VARCHAR(255) NOT NULL, cognome VARCHAR(255) NOT NULL, codice_fiscale VARCHAR(20) NOT NULL, telefono VARCHAR(20) NOT NULL, data_nascita DATE NOT NULL, luogo_nascita VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4E53279845924CB2 ON personefisiche (codice_fiscale)');
        $this->addSql('CREATE TABLE postazioni (id SERIAL NOT NULL, stanza_id INT NOT NULL, kit_postazione BOOLEAN NOT NULL, posto_occupato BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_169E4E00B1FA2985 ON postazioni (stanza_id)');
        $this->addSql('CREATE TABLE prenotazioni (id SERIAL NOT NULL, utente_id INT NOT NULL, postazione_id INT NOT NULL, data_prenotazione DATE NOT NULL, data_inizio_prenotazione DATE NOT NULL, data_fine_prenotazione DATE NOT NULL, stato INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F12DF0546FD5D2A ON prenotazioni (utente_id)');
        $this->addSql('CREATE INDEX IDX_F12DF05455DAA656 ON prenotazioni (postazione_id)');
        $this->addSql('CREATE TABLE ruoli (id SERIAL NOT NULL, permesso_id INT NOT NULL, descrizione_ruolo VARCHAR(255) NOT NULL, codice VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A77C655627DF0F57 ON ruoli (permesso_id)');
        $this->addSql('CREATE TABLE sede (id SERIAL NOT NULL, persone_giuridiche_id INT NOT NULL, indirizzo VARCHAR(255) NOT NULL, civico VARCHAR(255) NOT NULL, citta VARCHAR(255) NOT NULL, cap VARCHAR(255) NOT NULL, provincia VARCHAR(4) NOT NULL, sede_operativa BOOLEAN NOT NULL, telefono_sede VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2A9BE2D15D76013D ON sede (persone_giuridiche_id)');
        $this->addSql('CREATE TABLE stanze (id SERIAL NOT NULL, sede_id INT NOT NULL, piano INT NOT NULL, nome_stanza VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_19FDEA24E19F41BF ON stanze (sede_id)');
        $this->addSql('CREATE TABLE utenti (id SERIAL NOT NULL, persone_fisiche_id INT NOT NULL, ruoli_id INT NOT NULL, persona_giuridica_id INT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, password_precedente VARCHAR(255) NOT NULL, data_ultimo_aggiornamento TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, stato INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D7F3FFCBE7927C74 ON utenti (email)');
        $this->addSql('CREATE INDEX IDX_D7F3FFCBB1269F05 ON utenti (persone_fisiche_id)');
        $this->addSql('CREATE INDEX IDX_D7F3FFCB4F493560 ON utenti (ruoli_id)');
        $this->addSql('CREATE INDEX IDX_D7F3FFCBAB8502A7 ON utenti (persona_giuridica_id)');
        $this->addSql('ALTER TABLE postazioni ADD CONSTRAINT FK_169E4E00B1FA2985 FOREIGN KEY (stanza_id) REFERENCES stanze (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE prenotazioni ADD CONSTRAINT FK_F12DF0546FD5D2A FOREIGN KEY (utente_id) REFERENCES utenti (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE prenotazioni ADD CONSTRAINT FK_F12DF05455DAA656 FOREIGN KEY (postazione_id) REFERENCES postazioni (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ruoli ADD CONSTRAINT FK_A77C655627DF0F57 FOREIGN KEY (permesso_id) REFERENCES permessi (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sede ADD CONSTRAINT FK_2A9BE2D15D76013D FOREIGN KEY (persone_giuridiche_id) REFERENCES personeGiuridiche (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE stanze ADD CONSTRAINT FK_19FDEA24E19F41BF FOREIGN KEY (sede_id) REFERENCES sede (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE utenti ADD CONSTRAINT FK_D7F3FFCBB1269F05 FOREIGN KEY (persone_fisiche_id) REFERENCES personefisiche (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE utenti ADD CONSTRAINT FK_D7F3FFCB4F493560 FOREIGN KEY (ruoli_id) REFERENCES ruoli (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE utenti ADD CONSTRAINT FK_D7F3FFCBAB8502A7 FOREIGN KEY (persona_giuridica_id) REFERENCES personeGiuridiche (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE postazioni DROP CONSTRAINT FK_169E4E00B1FA2985');
        $this->addSql('ALTER TABLE prenotazioni DROP CONSTRAINT FK_F12DF0546FD5D2A');
        $this->addSql('ALTER TABLE prenotazioni DROP CONSTRAINT FK_F12DF05455DAA656');
        $this->addSql('ALTER TABLE ruoli DROP CONSTRAINT FK_A77C655627DF0F57');
        $this->addSql('ALTER TABLE sede DROP CONSTRAINT FK_2A9BE2D15D76013D');
        $this->addSql('ALTER TABLE stanze DROP CONSTRAINT FK_19FDEA24E19F41BF');
        $this->addSql('ALTER TABLE utenti DROP CONSTRAINT FK_D7F3FFCBB1269F05');
        $this->addSql('ALTER TABLE utenti DROP CONSTRAINT FK_D7F3FFCB4F493560');
        $this->addSql('ALTER TABLE utenti DROP CONSTRAINT FK_D7F3FFCBAB8502A7');
        $this->addSql('DROP TABLE permessi');
        $this->addSql('DROP TABLE personeGiuridiche');
        $this->addSql('DROP TABLE personefisiche');
        $this->addSql('DROP TABLE postazioni');
        $this->addSql('DROP TABLE prenotazioni');
        $this->addSql('DROP TABLE ruoli');
        $this->addSql('DROP TABLE sede');
        $this->addSql('DROP TABLE stanze');
        $this->addSql('DROP TABLE utenti');
    }
}
