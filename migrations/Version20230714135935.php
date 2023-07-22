<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230714135935 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE opinion_visitors DROP FOREIGN KEY FK_81962896D475AB2E');
        $this->addSql('ALTER TABLE opinion_visitors DROP FOREIGN KEY FK_8196289651885A6A');
        $this->addSql('DROP TABLE opinion_visitors');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D14D475AB2E');
        $this->addSql('DROP INDEX IDX_95C71D14D475AB2E ON cars');
        $this->addSql('ALTER TABLE cars DROP visitors_id');
        $this->addSql('ALTER TABLE service ADD picture VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE opinion_visitors (opinion_id INT NOT NULL, visitors_id INT NOT NULL, INDEX IDX_81962896D475AB2E (visitors_id), INDEX IDX_8196289651885A6A (opinion_id), PRIMARY KEY(opinion_id, visitors_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE opinion_visitors ADD CONSTRAINT FK_81962896D475AB2E FOREIGN KEY (visitors_id) REFERENCES visitors (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE opinion_visitors ADD CONSTRAINT FK_8196289651885A6A FOREIGN KEY (opinion_id) REFERENCES opinion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cars ADD visitors_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D14D475AB2E FOREIGN KEY (visitors_id) REFERENCES visitors (id)');
        $this->addSql('CREATE INDEX IDX_95C71D14D475AB2E ON cars (visitors_id)');
        $this->addSql('ALTER TABLE service DROP picture');
    }
}
