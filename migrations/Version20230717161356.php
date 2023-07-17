<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230717161356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D143A650E3A');
        $this->addSql('DROP INDEX IDX_95C71D143A650E3A ON cars');
        $this->addSql('ALTER TABLE cars DROP carscatalogue_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cars ADD carscatalogue_id INT NOT NULL');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D143A650E3A FOREIGN KEY (carscatalogue_id) REFERENCES cars_catalogue (id)');
        $this->addSql('CREATE INDEX IDX_95C71D143A650E3A ON cars (carscatalogue_id)');
    }
}
