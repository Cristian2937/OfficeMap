<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230331124206 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ruoli DROP CONSTRAINT fk_a77c65566fd5d2a');
        $this->addSql('DROP INDEX idx_a77c65566fd5d2a');
        $this->addSql('ALTER TABLE ruoli DROP utente_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE ruoli ADD utente_id INT NOT NULL');
        $this->addSql('ALTER TABLE ruoli ADD CONSTRAINT fk_a77c65566fd5d2a FOREIGN KEY (utente_id) REFERENCES utenti (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_a77c65566fd5d2a ON ruoli (utente_id)');
    }
}
