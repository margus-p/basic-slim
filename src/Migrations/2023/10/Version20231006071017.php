<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231006071017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add entity SiteVisit';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE site_visits (id INT AUTO_INCREMENT NOT NULL, ipAddress VARCHAR(45) NOT NULL, userAgent VARCHAR(512) NOT NULL, url VARCHAR(512) NOT NULL, referrer VARCHAR(512) DEFAULT NULL, createdAt DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX idx_site_visits_ip_address (ipAddress), INDEX idx_site_visits_created_at (createdAt), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE site_visits');
    }

}
