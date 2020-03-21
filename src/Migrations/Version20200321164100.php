<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200321164100 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pre_existing_condition (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facility (id INT AUTO_INCREMENT NOT NULL, address_id INT NOT NULL, name VARCHAR(255) NOT NULL, free_space INT NOT NULL, occupied_space INT NOT NULL, UNIQUE INDEX UNIQ_105994B2F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE symptom (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, degree INT NOT NULL, starting_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, tests_id INT NOT NULL, result TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_D87F7E0CF5D80971 (tests_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE risk_factors (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, appointment_id INT DEFAULT NULL, note LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_1ADAD7EBE5B533F9 (appointment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient_symptom (patient_id INT NOT NULL, symptom_id INT NOT NULL, INDEX IDX_B9A1A54B6B899279 (patient_id), INDEX IDX_B9A1A54BDEEFDA95 (symptom_id), PRIMARY KEY(patient_id, symptom_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient_pre_existing_condition (patient_id INT NOT NULL, pre_existing_condition_id INT NOT NULL, INDEX IDX_5532816C6B899279 (patient_id), INDEX IDX_5532816CA513ED5A (pre_existing_condition_id), PRIMARY KEY(patient_id, pre_existing_condition_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient_risk_factors (patient_id INT NOT NULL, risk_factors_id INT NOT NULL, INDEX IDX_B7AFC6966B899279 (patient_id), INDEX IDX_B7AFC696A5A246DD (risk_factors_id), PRIMARY KEY(patient_id, risk_factors_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, address_id INT NOT NULL, name VARCHAR(30) NOT NULL, surname VARCHAR(50) NOT NULL, birthdate DATE NOT NULL, phone_nr VARCHAR(15) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, INDEX IDX_34DCD176F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE appointment (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, street VARCHAR(255) NOT NULL, nr VARCHAR(10) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, zip_code VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE facility ADD CONSTRAINT FK_105994B2F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE test ADD CONSTRAINT FK_D87F7E0CF5D80971 FOREIGN KEY (tests_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBE5B533F9 FOREIGN KEY (appointment_id) REFERENCES appointment (id)');
        $this->addSql('ALTER TABLE patient_symptom ADD CONSTRAINT FK_B9A1A54B6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patient_symptom ADD CONSTRAINT FK_B9A1A54BDEEFDA95 FOREIGN KEY (symptom_id) REFERENCES symptom (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patient_pre_existing_condition ADD CONSTRAINT FK_5532816C6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patient_pre_existing_condition ADD CONSTRAINT FK_5532816CA513ED5A FOREIGN KEY (pre_existing_condition_id) REFERENCES pre_existing_condition (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patient_risk_factors ADD CONSTRAINT FK_B7AFC6966B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patient_risk_factors ADD CONSTRAINT FK_B7AFC696A5A246DD FOREIGN KEY (risk_factors_id) REFERENCES risk_factors (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE patient_pre_existing_condition DROP FOREIGN KEY FK_5532816CA513ED5A');
        $this->addSql('ALTER TABLE patient_symptom DROP FOREIGN KEY FK_B9A1A54BDEEFDA95');
        $this->addSql('ALTER TABLE patient_risk_factors DROP FOREIGN KEY FK_B7AFC696A5A246DD');
        $this->addSql('ALTER TABLE test DROP FOREIGN KEY FK_D87F7E0CF5D80971');
        $this->addSql('ALTER TABLE patient_symptom DROP FOREIGN KEY FK_B9A1A54B6B899279');
        $this->addSql('ALTER TABLE patient_pre_existing_condition DROP FOREIGN KEY FK_5532816C6B899279');
        $this->addSql('ALTER TABLE patient_risk_factors DROP FOREIGN KEY FK_B7AFC6966B899279');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EBE5B533F9');
        $this->addSql('ALTER TABLE facility DROP FOREIGN KEY FK_105994B2F5B7AF75');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176F5B7AF75');
        $this->addSql('DROP TABLE pre_existing_condition');
        $this->addSql('DROP TABLE facility');
        $this->addSql('DROP TABLE symptom');
        $this->addSql('DROP TABLE test');
        $this->addSql('DROP TABLE risk_factors');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE patient_symptom');
        $this->addSql('DROP TABLE patient_pre_existing_condition');
        $this->addSql('DROP TABLE patient_risk_factors');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE appointment');
        $this->addSql('DROP TABLE address');
    }
}
