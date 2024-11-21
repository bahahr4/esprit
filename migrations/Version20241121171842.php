<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241121171842 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        //hedhom 3 ostra chenbadalhom khater mahabech yekbel date Null 0000:00:00 pfffffff
        // this up() migration is auto-generated, please modify it to your needs
       // $this->addSql('ALTER TABLE reclamation ADD daterecl DATE NOT NULL');
        // Modifier le champ pour qu'il accepte les valeurs nulles au départ
        $this->addSql('ALTER TABLE reclamation ADD daterecl DATE DEFAULT NULL');

        // Mettre à jour toutes les lignes existantes pour définir une valeur par défaut, comme la date actuelle
        $this->addSql('UPDATE reclamation SET daterecl = CURDATE() WHERE daterecl IS NULL');

        // Rendre la colonne non-nullable après avoir mis à jour les valeurs existantes
        $this->addSql('ALTER TABLE reclamation MODIFY daterecl DATE NOT NULL');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reclamation DROP daterecl');
    }
}
