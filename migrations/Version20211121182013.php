<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211121182013 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actes_categories (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, images VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE actes_prestations (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, designation LONGTEXT DEFAULT NULL, INDEX IDX_3815B604BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE belgique_code_postaux (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, localite VARCHAR(255) NOT NULL, latitude NUMERIC(10, 3) NOT NULL, longitude NUMERIC(10, 3) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE horaires_disponibilite (id INT AUTO_INCREMENT NOT NULL, jour_id INT NOT NULL, is_active TINYINT(1) NOT NULL, start_at TIME NOT NULL, finish_at TIME NOT NULL, INDEX IDX_6CCD6FB8220C6AD0 (jour_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE horaires_jours (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patients_enregistrer (id INT AUTO_INCREMENT NOT NULL, code_postal_id INT NOT NULL, email VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) DEFAULT NULL, contact VARCHAR(255) DEFAULT NULL, numero_porte VARCHAR(255) NOT NULL, INDEX IDX_986F57F6B2B59251 (code_postal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservations (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', patients_enregistrer_id INT NOT NULL, gestionnaire_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', statut INT NOT NULL, prestations LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', localisation VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_4DA239FFFF7D90 (patients_enregistrer_id), INDEX IDX_4DA2396885AC1B (gestionnaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservations_horaires (id INT AUTO_INCREMENT NOT NULL, reservation_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', horaires_disponibilites_id INT NOT NULL, other_date DATE DEFAULT NULL, statut TINYINT(1) DEFAULT NULL, start_at TIME NOT NULL, finish_at TIME NOT NULL, date DATE NOT NULL, INDEX IDX_5851D62EB83297E7 (reservation_id), INDEX IDX_5851D62E60D3A254 (horaires_disponibilites_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test_pcr (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, start_at DATETIME NOT NULL, finish_at DATETIME NOT NULL, localisation VARCHAR(255) NOT NULL, is_current TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateurs (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_497B315EE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE actes_prestations ADD CONSTRAINT FK_3815B604BCF5E72D FOREIGN KEY (categorie_id) REFERENCES actes_categories (id)');
        $this->addSql('ALTER TABLE horaires_disponibilite ADD CONSTRAINT FK_6CCD6FB8220C6AD0 FOREIGN KEY (jour_id) REFERENCES horaires_jours (id)');
        $this->addSql('ALTER TABLE patients_enregistrer ADD CONSTRAINT FK_986F57F6B2B59251 FOREIGN KEY (code_postal_id) REFERENCES belgique_code_postaux (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA239FFFF7D90 FOREIGN KEY (patients_enregistrer_id) REFERENCES patients_enregistrer (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA2396885AC1B FOREIGN KEY (gestionnaire_id) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE reservations_horaires ADD CONSTRAINT FK_5851D62EB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservations (id)');
        $this->addSql('ALTER TABLE reservations_horaires ADD CONSTRAINT FK_5851D62E60D3A254 FOREIGN KEY (horaires_disponibilites_id) REFERENCES horaires_disponibilite (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actes_prestations DROP FOREIGN KEY FK_3815B604BCF5E72D');
        $this->addSql('ALTER TABLE patients_enregistrer DROP FOREIGN KEY FK_986F57F6B2B59251');
        $this->addSql('ALTER TABLE reservations_horaires DROP FOREIGN KEY FK_5851D62E60D3A254');
        $this->addSql('ALTER TABLE horaires_disponibilite DROP FOREIGN KEY FK_6CCD6FB8220C6AD0');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239FFFF7D90');
        $this->addSql('ALTER TABLE reservations_horaires DROP FOREIGN KEY FK_5851D62EB83297E7');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA2396885AC1B');
        $this->addSql('DROP TABLE actes_categories');
        $this->addSql('DROP TABLE actes_prestations');
        $this->addSql('DROP TABLE belgique_code_postaux');
        $this->addSql('DROP TABLE horaires_disponibilite');
        $this->addSql('DROP TABLE horaires_jours');
        $this->addSql('DROP TABLE patients_enregistrer');
        $this->addSql('DROP TABLE reservations');
        $this->addSql('DROP TABLE reservations_horaires');
        $this->addSql('DROP TABLE test_pcr');
        $this->addSql('DROP TABLE utilisateurs');
    }
}
