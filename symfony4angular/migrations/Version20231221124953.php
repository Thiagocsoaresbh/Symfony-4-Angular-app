<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231221124953 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE purchase ADD date DATETIME NOT NULL, ADD address1 VARCHAR(255) NOT NULL, ADD city VARCHAR(255) NOT NULL, ADD postcode VARCHAR(255) NOT NULL, ADD country VARCHAR(255) NOT NULL, ADD amount NUMERIC(10, 2) NOT NULL');
        $this->addSql('ALTER TABLE purchase CHANGE date date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE purchase DROP date, DROP address1, DROP city, DROP postcode, DROP country, DROP amount');
    }
}
