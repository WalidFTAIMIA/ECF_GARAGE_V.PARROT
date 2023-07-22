<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230722143003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cars (id INT AUTO_INCREMENT NOT NULL, cars_brand VARCHAR(100) NOT NULL, cars_model VARCHAR(100) NOT NULL, cars_price DOUBLE PRECISION NOT NULL, cars_km INT NOT NULL, cars_energy VARCHAR(100) NOT NULL, cars_year DATETIME NOT NULL, picture VARCHAR(255) NOT NULL, description_cars VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cars_catalogue (id INT AUTO_INCREMENT NOT NULL, picture_cars_catalogue VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, title VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, name_contact VARCHAR(255) NOT NULL, email_contact VARCHAR(255) NOT NULL, message_contact LONGTEXT NOT NULL, phone_contact VARCHAR(30) NOT NULL, INDEX IDX_4C62E63867B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, name VARCHAR(30) DEFAULT NULL, INDEX IDX_5D9F75A167B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee_opinion (employee_id INT NOT NULL, opinion_id INT NOT NULL, INDEX IDX_2B4EE6288C03F15C (employee_id), INDEX IDX_2B4EE62851885A6A (opinion_id), PRIMARY KEY(employee_id, opinion_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee_cars (employee_id INT NOT NULL, cars_id INT NOT NULL, INDEX IDX_201E57538C03F15C (employee_id), INDEX IDX_201E57538702F506 (cars_id), PRIMARY KEY(employee_id, cars_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE home (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE opinion (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, name_opinion VARCHAR(100) NOT NULL, message_opinion VARCHAR(255) NOT NULL, approved_opinion TINYINT(1) NOT NULL, INDEX IDX_AB02B02767B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, picture VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE times (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, day VARCHAR(255) NOT NULL, morning_opening_time VARCHAR(255) DEFAULT NULL, morning_closing_time VARCHAR(255) DEFAULT NULL, afternoon_opening_time VARCHAR(255) DEFAULT NULL, afternoon_closing_time VARCHAR(255) DEFAULT NULL, INDEX IDX_1DD7EE8C67B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visitors (id INT AUTO_INCREMENT NOT NULL, name_visitors VARCHAR(255) NOT NULL, email_visitors VARCHAR(255) NOT NULL, phone_visitors INT NOT NULL, picture_visitors VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E63867B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A167B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE employee_opinion ADD CONSTRAINT FK_2B4EE6288C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employee_opinion ADD CONSTRAINT FK_2B4EE62851885A6A FOREIGN KEY (opinion_id) REFERENCES opinion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employee_cars ADD CONSTRAINT FK_201E57538C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employee_cars ADD CONSTRAINT FK_201E57538702F506 FOREIGN KEY (cars_id) REFERENCES cars (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE opinion ADD CONSTRAINT FK_AB02B02767B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE times ADD CONSTRAINT FK_1DD7EE8C67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E63867B3B43D');
        $this->addSql('ALTER TABLE employee DROP FOREIGN KEY FK_5D9F75A167B3B43D');
        $this->addSql('ALTER TABLE employee_opinion DROP FOREIGN KEY FK_2B4EE6288C03F15C');
        $this->addSql('ALTER TABLE employee_opinion DROP FOREIGN KEY FK_2B4EE62851885A6A');
        $this->addSql('ALTER TABLE employee_cars DROP FOREIGN KEY FK_201E57538C03F15C');
        $this->addSql('ALTER TABLE employee_cars DROP FOREIGN KEY FK_201E57538702F506');
        $this->addSql('ALTER TABLE opinion DROP FOREIGN KEY FK_AB02B02767B3B43D');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE times DROP FOREIGN KEY FK_1DD7EE8C67B3B43D');
        $this->addSql('DROP TABLE cars');
        $this->addSql('DROP TABLE cars_catalogue');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE employee_opinion');
        $this->addSql('DROP TABLE employee_cars');
        $this->addSql('DROP TABLE home');
        $this->addSql('DROP TABLE opinion');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE times');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE visitors');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
