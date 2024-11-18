<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241119181305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add created_at and datecreation columns to student table';
    }

    public function up(Schema $schema): void
    {
        // Étape 1 : Ajouter les colonnes created_at et datecreation en tant que nullable
        $this->addSql('ALTER TABLE student ADD created_at DATETIME DEFAULT NULL, ADD datecreation DATE DEFAULT NULL');

        // Étape 2 : Mettre à jour toutes les lignes existantes avec la date actuelle
        $this->addSql('UPDATE student SET created_at = NOW() WHERE created_at IS NULL');
        $this->addSql('UPDATE student SET datecreation = CURDATE() WHERE datecreation IS NULL');

        // Étape 3 : Modifier les colonnes pour les rendre non nullable
        $this->addSql('ALTER TABLE student MODIFY created_at DATETIME NOT NULL, MODIFY datecreation DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // Revenir en arrière et supprimer les colonnes
        $this->addSql('ALTER TABLE student DROP created_at, DROP datecreation');
    }
}
