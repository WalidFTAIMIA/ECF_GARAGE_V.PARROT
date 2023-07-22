<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230717154528 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cars (id INT AUTO_INCREMENT NOT NULL, carscatalogue_id INT NOT NULL, cars_brand VARCHAR(100) NOT NULL, cars_model VARCHAR(100) NOT NULL, cars_price DOUBLE PRECISION NOT NULL, cars_km INT NOT NULL, cars_energy VARCHAR(100) NOT NULL, cars_year DATETIME NOT NULL, picture VARCHAR(255) NOT NULL, INDEX IDX_95C71D143A650E3A (carscatalogue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cars_catalogue (id INT AUTO_INCREMENT NOT NULL, picture_cars_catalogue VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, title VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, INDEX IDX_5D9F75A167B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee_opinion (employee_id INT NOT NULL, opinion_id INT NOT NULL, INDEX IDX_2B4EE6288C03F15C (employee_id), INDEX IDX_2B4EE62851885A6A (opinion_id), PRIMARY KEY(employee_id, opinion_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee_cars (employee_id INT NOT NULL, cars_id INT NOT NULL, INDEX IDX_201E57538C03F15C (employee_id), INDEX IDX_201E57538702F506 (cars_id), PRIMARY KEY(employee_id, cars_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE opinion (id INT AUTO_INCREMENT NOT NULL, name_opinion VARCHAR(100) NOT NULL, email_opinion VARCHAR(255) NOT NULL, phone_opinion INT NOT NULL, message_opinion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visitors (id INT AUTO_INCREMENT NOT NULL, name_visitors VARCHAR(255) NOT NULL, email_visitors VARCHAR(255) NOT NULL, phone_visitors INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D143A650E3A FOREIGN KEY (carscatalogue_id) REFERENCES cars_catalogue (id)');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A167B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE employee_opinion ADD CONSTRAINT FK_2B4EE6288C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employee_opinion ADD CONSTRAINT FK_2B4EE62851885A6A FOREIGN KEY (opinion_id) REFERENCES opinion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employee_cars ADD CONSTRAINT FK_201E57538C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employee_cars ADD CONSTRAINT FK_201E57538702F506 FOREIGN KEY (cars_id) REFERENCES cars (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69D4A7843DC');
        $this->addSql('DROP TABLE car');
        $this->addSql('DROP TABLE catalogue');
        $this->addSql('ALTER TABLE users DROP name');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, catalogue_id INT DEFAULT NULL, carbrand VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, carmodel VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, carprice DOUBLE PRECISION NOT NULL, caryear DATE NOT NULL, carkm INT NOT NULL, carenergy VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, cardescription VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, carpicture VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_773DE69D4A7843DC (catalogue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE catalogue (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D4A7843DC FOREIGN KEY (catalogue_id) REFERENCES catalogue (id)');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D143A650E3A');
        $this->addSql('ALTER TABLE employee DROP FOREIGN KEY FK_5D9F75A167B3B43D');
        $this->addSql('ALTER TABLE employee_opinion DROP FOREIGN KEY FK_2B4EE6288C03F15C');
        $this->addSql('ALTER TABLE employee_opinion DROP FOREIGN KEY FK_2B4EE62851885A6A');
        $this->addSql('ALTER TABLE employee_cars DROP FOREIGN KEY FK_201E57538C03F15C');
        $this->addSql('ALTER TABLE employee_cars DROP FOREIGN KEY FK_201E57538702F506');
        $this->addSql('DROP TABLE cars');
        $this->addSql('DROP TABLE cars_catalogue');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE employee_opinion');
        $this->addSql('DROP TABLE employee_cars');
        $this->addSql('DROP TABLE opinion');
        $this->addSql('DROP TABLE visitors');
        $this->addSql('ALTER TABLE users ADD name VARCHAR(255) DEFAULT NULL');
    }
}
