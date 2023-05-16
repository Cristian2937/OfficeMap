<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230331120527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE permessi ADD ruolo_id INT NOT NULL');
        $this->addSql('ALTER TABLE permessi ADD CONSTRAINT FK_5D87107C6A226ABC FOREIGN KEY (ruolo_id) REFERENCES ruoli (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5D87107C6A226ABC ON permessi (ruolo_id)');
        $this->addSql('ALTER TABLE ruoli DROP CONSTRAINT fk_a77c655627df0f57');
        $this->addSql('DROP INDEX uniq_a77c655627df0f57');
        $this->addSql('ALTER TABLE ruoli DROP permesso_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE ruoli ADD permesso_id INT NOT NULL');
        $this->addSql('ALTER TABLE ruoli ADD CONSTRAINT fk_a77c655627df0f57 FOREIGN KEY (permesso_id) REFERENCES permessi (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_a77c655627df0f57 ON ruoli (permesso_id)');
        $this->addSql('ALTER TABLE permessi DROP CONSTRAINT FK_5D87107C6A226ABC');
        $this->addSql('DROP INDEX UNIQ_5D87107C6A226ABC');
        $this->addSql('ALTER TABLE permessi DROP ruolo_id');
    }
}
