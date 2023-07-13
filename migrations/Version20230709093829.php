<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230709093829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE visitors_services DROP FOREIGN KEY FK_FBBF4B46AEF5A6C1');
        $this->addSql('ALTER TABLE visitors_services DROP FOREIGN KEY FK_FBBF4B46D475AB2E');
        $this->addSql('DROP TABLE visitors_services');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE visitors_services (visitors_id INT NOT NULL, services_id INT NOT NULL, INDEX IDX_FBBF4B46AEF5A6C1 (services_id), INDEX IDX_FBBF4B46D475AB2E (visitors_id), PRIMARY KEY(visitors_id, services_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE visitors_services ADD CONSTRAINT FK_FBBF4B46AEF5A6C1 FOREIGN KEY (services_id) REFERENCES services (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE visitors_services ADD CONSTRAINT FK_FBBF4B46D475AB2E FOREIGN KEY (visitors_id) REFERENCES visitors (id) ON DELETE CASCADE');
    }
}
