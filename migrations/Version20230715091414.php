<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230715091414 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE employee_opinion (employee_id INT NOT NULL, opinion_id INT NOT NULL, INDEX IDX_2B4EE6288C03F15C (employee_id), INDEX IDX_2B4EE62851885A6A (opinion_id), PRIMARY KEY(employee_id, opinion_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee_cars (employee_id INT NOT NULL, cars_id INT NOT NULL, INDEX IDX_201E57538C03F15C (employee_id), INDEX IDX_201E57538702F506 (cars_id), PRIMARY KEY(employee_id, cars_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE employee_opinion ADD CONSTRAINT FK_2B4EE6288C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employee_opinion ADD CONSTRAINT FK_2B4EE62851885A6A FOREIGN KEY (opinion_id) REFERENCES opinion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employee_cars ADD CONSTRAINT FK_201E57538C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employee_cars ADD CONSTRAINT FK_201E57538702F506 FOREIGN KEY (cars_id) REFERENCES cars (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employee_opinion DROP FOREIGN KEY FK_2B4EE6288C03F15C');
        $this->addSql('ALTER TABLE employee_opinion DROP FOREIGN KEY FK_2B4EE62851885A6A');
        $this->addSql('ALTER TABLE employee_cars DROP FOREIGN KEY FK_201E57538C03F15C');
        $this->addSql('ALTER TABLE employee_cars DROP FOREIGN KEY FK_201E57538702F506');
        $this->addSql('DROP TABLE employee_opinion');
        $this->addSql('DROP TABLE employee_cars');
    }
}
