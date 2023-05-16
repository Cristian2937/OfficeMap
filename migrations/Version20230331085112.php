<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230331085112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stanze DROP CONSTRAINT fk_19fdea24e19f41bf');
        $this->addSql('ALTER TABLE utenti DROP CONSTRAINT fk_d7f3ffcbb1269f05');
        $this->addSql('ALTER TABLE utenti DROP CONSTRAINT fk_d7f3ffcbab8502a7');
        $this->addSql('DROP SEQUENCE pilota_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE personegiuridiche_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE personefisiche_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sede_id_seq CASCADE');
        $this->addSql('CREATE TABLE persone_fisiche (id SERIAL NOT NULL, nome VARCHAR(255) NOT NULL, cognome VARCHAR(255) NOT NULL, codice_fiscale VARCHAR(20) NOT NULL, telefono VARCHAR(20) NOT NULL, data_nascita DATE NOT NULL, luogo_nascita VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_23D1D5A245924CB2 ON persone_fisiche (codice_fiscale)');
        $this->addSql('CREATE TABLE persone_giuridiche (id SERIAL NOT NULL, ragione_sociale VARCHAR(255) NOT NULL, partita_iva VARCHAR(16) NOT NULL, telefono VARCHAR(20) NOT NULL, mail_aziendale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_90825974E0B88091 ON persone_giuridiche (partita_iva)');
        $this->addSql('CREATE TABLE sedi (id SERIAL NOT NULL, persona_giuridica_id INT NOT NULL, indirizzo VARCHAR(255) NOT NULL, civico VARCHAR(255) NOT NULL, citta VARCHAR(255) NOT NULL, cap VARCHAR(255) NOT NULL, provincia VARCHAR(4) NOT NULL, sede_operativa BOOLEAN NOT NULL, telefono_sede VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_232DAEFAAB8502A7 ON sedi (persona_giuridica_id)');
        $this->addSql('ALTER TABLE sedi ADD CONSTRAINT FK_232DAEFAAB8502A7 FOREIGN KEY (persona_giuridica_id) REFERENCES persone_giuridiche (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sede DROP CONSTRAINT fk_2a9be2d15d76013d');
        $this->addSql('DROP TABLE sede');
        $this->addSql('DROP TABLE personefisiche');
        $this->addSql('DROP TABLE pilota');
        $this->addSql('DROP TABLE personegiuridiche');
        $this->addSql('ALTER TABLE postazioni DROP posto_occupato');
        $this->addSql('ALTER TABLE ruoli ADD utente_id INT NOT NULL');
        $this->addSql('ALTER TABLE ruoli ADD stato INT NOT NULL');
        $this->addSql('ALTER TABLE ruoli ADD default_route VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE ruoli ADD CONSTRAINT FK_A77C65566FD5D2A FOREIGN KEY (utente_id) REFERENCES utenti (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_A77C65566FD5D2A ON ruoli (utente_id)');
        $this->addSql('ALTER TABLE stanze ADD CONSTRAINT FK_19FDEA24E19F41BF FOREIGN KEY (sede_id) REFERENCES sedi (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE utenti DROP CONSTRAINT fk_d7f3ffcb4f493560');

        $this->addSql('DROP INDEX idx_d7f3ffcb4f493560');
        $this->addSql('DROP INDEX idx_d7f3ffcbb1269f05');
        $this->addSql('ALTER TABLE utenti ADD persona_fisica_id INT NOT NULL');
        $this->addSql('ALTER TABLE utenti ADD ruolo_id INT NOT NULL');
        $this->addSql('ALTER TABLE utenti DROP persone_fisiche_id');
        $this->addSql('ALTER TABLE utenti DROP ruoli_id');
        $this->addSql('ALTER TABLE utenti ADD CONSTRAINT FK_D7F3FFCB319CE0FF FOREIGN KEY (persona_fisica_id) REFERENCES persone_fisiche (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE utenti ADD CONSTRAINT FK_D7F3FFCB6A226ABC FOREIGN KEY (ruolo_id) REFERENCES ruoli (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE utenti ADD CONSTRAINT FK_D7F3FFCBAB8502A7 FOREIGN KEY (persona_giuridica_id) REFERENCES persone_giuridiche (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D7F3FFCB319CE0FF ON utenti (persona_fisica_id)');
        $this->addSql('CREATE INDEX IDX_D7F3FFCB6A226ABC ON utenti (ruolo_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE utenti DROP CONSTRAINT FK_D7F3FFCB319CE0FF');
        $this->addSql('ALTER TABLE utenti DROP CONSTRAINT FK_D7F3FFCBAB8502A7');
        $this->addSql('ALTER TABLE stanze DROP CONSTRAINT FK_19FDEA24E19F41BF');
        $this->addSql('CREATE SEQUENCE pilota_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE personegiuridiche_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE personefisiche_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sede_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE sede (id SERIAL NOT NULL, persone_giuridiche_id INT NOT NULL, indirizzo VARCHAR(255) NOT NULL, civico VARCHAR(255) NOT NULL, citta VARCHAR(255) NOT NULL, cap VARCHAR(255) NOT NULL, provincia VARCHAR(4) NOT NULL, sede_operativa BOOLEAN NOT NULL, telefono_sede VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_2a9be2d15d76013d ON sede (persone_giuridiche_id)');
        $this->addSql('CREATE TABLE personefisiche (id SERIAL NOT NULL, nome VARCHAR(255) NOT NULL, cognome VARCHAR(255) NOT NULL, codice_fiscale VARCHAR(20) NOT NULL, telefono VARCHAR(20) NOT NULL, data_nascita DATE NOT NULL, luogo_nascita VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_4e53279845924cb2 ON personefisiche (codice_fiscale)');
        $this->addSql('CREATE TABLE pilota (id INT NOT NULL, nome VARCHAR(255) NOT NULL, data_nascita DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE personegiuridiche (id SERIAL NOT NULL, ragione_sociale VARCHAR(255) NOT NULL, partita_iva VARCHAR(16) NOT NULL, telefono VARCHAR(20) NOT NULL, mail_aziendale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_d31f5bbce0b88091 ON personegiuridiche (partita_iva)');
        $this->addSql('ALTER TABLE sede ADD CONSTRAINT fk_2a9be2d15d76013d FOREIGN KEY (persone_giuridiche_id) REFERENCES personegiuridiche (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sedi DROP CONSTRAINT FK_232DAEFAAB8502A7');
        $this->addSql('DROP TABLE persone_fisiche');
        $this->addSql('DROP TABLE persone_giuridiche');
        $this->addSql('DROP TABLE sedi');
        $this->addSql('ALTER TABLE ruoli DROP CONSTRAINT FK_A77C65566FD5D2A');
        $this->addSql('DROP INDEX IDX_A77C65566FD5D2A');
        $this->addSql('ALTER TABLE ruoli DROP utente_id');
        $this->addSql('ALTER TABLE ruoli DROP stato');
        $this->addSql('ALTER TABLE ruoli DROP default_route');
        $this->addSql('ALTER TABLE stanze DROP CONSTRAINT fk_19fdea24e19f41bf');
        $this->addSql('ALTER TABLE stanze ADD CONSTRAINT fk_19fdea24e19f41bf FOREIGN KEY (sede_id) REFERENCES sede (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE postazioni ADD posto_occupato BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE utenti DROP CONSTRAINT FK_D7F3FFCB6A226ABC');
        $this->addSql('ALTER TABLE utenti DROP CONSTRAINT fk_d7f3ffcbab8502a7');
        $this->addSql('DROP INDEX IDX_D7F3FFCB319CE0FF');
        $this->addSql('DROP INDEX IDX_D7F3FFCB6A226ABC');
        $this->addSql('ALTER TABLE utenti ADD persone_fisiche_id INT NOT NULL');
        $this->addSql('ALTER TABLE utenti ADD ruoli_id INT NOT NULL');
        $this->addSql('ALTER TABLE utenti DROP persona_fisica_id');
        $this->addSql('ALTER TABLE utenti DROP ruolo_id');
        $this->addSql('ALTER TABLE utenti ADD CONSTRAINT fk_d7f3ffcbb1269f05 FOREIGN KEY (persone_fisiche_id) REFERENCES personefisiche (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE utenti ADD CONSTRAINT fk_d7f3ffcb4f493560 FOREIGN KEY (ruoli_id) REFERENCES ruoli (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE utenti ADD CONSTRAINT fk_d7f3ffcbab8502a7 FOREIGN KEY (persona_giuridica_id) REFERENCES personegiuridiche (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_d7f3ffcb4f493560 ON utenti (ruoli_id)');
        $this->addSql('CREATE INDEX idx_d7f3ffcbb1269f05 ON utenti (persone_fisiche_id)');
    }
}
