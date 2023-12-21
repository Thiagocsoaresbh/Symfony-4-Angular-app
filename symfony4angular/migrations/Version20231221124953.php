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
        $this->addSql(
            'CREATE TABLE purchase
        (
            id INT AUTO_INCREMENT NOT NULL,
            date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
            customer VARCHAR(255) NOT NULL,
            address1 VARCHAR(255) NOT NULL,
            city VARCHAR(255) NOT NULL,
            postcode VARCHAR(255) NOT NULL,
            country VARCHAR(255) NOT NULL,
            amount NUMERIC(10, 2) NOT NULL,
            status VARCHAR(255) NOT NULL,
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
    '
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE purchase DROP date, DROP address1, DROP city, DROP postcode, DROP country, DROP amount');
    }
}
