<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250909183609 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coupon (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(20) NOT NULL, type VARCHAR(255) NOT NULL, value NUMERIC(20, 2) NOT NULL, UNIQUE INDEX UNIQ_64BF3F0277153098 (code), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price NUMERIC(20, 2) NOT NULL, currency VARCHAR(10) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE tax (id INT AUTO_INCREMENT NOT NULL, country VARCHAR(255) NOT NULL, tax_number VARCHAR(255) NOT NULL, percent NUMERIC(4, 1) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE coupon');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE tax');
    }
}
