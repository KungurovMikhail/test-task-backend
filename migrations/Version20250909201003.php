<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250909201003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tax ADD country_code VARCHAR(255) NOT NULL, DROP country, DROP tax_number');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8E81BA76F026BB7C ON tax (country_code)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_8E81BA76F026BB7C ON tax');
        $this->addSql('ALTER TABLE tax ADD tax_number VARCHAR(255) NOT NULL, CHANGE country_code country VARCHAR(255) NOT NULL');
    }
}
