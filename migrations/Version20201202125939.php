<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201202125939 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE groupe_de_competences (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, descriptif VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe_de_competences_competence (groupe_de_competences_id INT NOT NULL, competence_id INT NOT NULL, INDEX IDX_12FFDA098C17E6FF (groupe_de_competences_id), INDEX IDX_12FFDA0915761DAB (competence_id), PRIMARY KEY(groupe_de_competences_id, competence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE groupe_de_competences_competence ADD CONSTRAINT FK_12FFDA098C17E6FF FOREIGN KEY (groupe_de_competences_id) REFERENCES groupe_de_competences (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groupe_de_competences_competence ADD CONSTRAINT FK_12FFDA0915761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE groupe_de_competences_competence DROP FOREIGN KEY FK_12FFDA098C17E6FF');
        $this->addSql('DROP TABLE groupe_de_competences');
        $this->addSql('DROP TABLE groupe_de_competences_competence');
    }
}
