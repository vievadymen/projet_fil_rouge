<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201204155409 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE referentiel (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, presentation VARCHAR(255) NOT NULL, critere_evaluation VARCHAR(255) NOT NULL, critere_admission VARCHAR(255) NOT NULL, programme VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE referentiel_groupe_de_competences (referentiel_id INT NOT NULL, groupe_de_competences_id INT NOT NULL, INDEX IDX_30F60FFB805DB139 (referentiel_id), INDEX IDX_30F60FFB8C17E6FF (groupe_de_competences_id), PRIMARY KEY(referentiel_id, groupe_de_competences_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE referentiel_groupe_de_competences ADD CONSTRAINT FK_30F60FFB805DB139 FOREIGN KEY (referentiel_id) REFERENCES referentiel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE referentiel_groupe_de_competences ADD CONSTRAINT FK_30F60FFB8C17E6FF FOREIGN KEY (groupe_de_competences_id) REFERENCES groupe_de_competences (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE referentiel_groupe_de_competences DROP FOREIGN KEY FK_30F60FFB805DB139');
        $this->addSql('DROP TABLE referentiel');
        $this->addSql('DROP TABLE referentiel_groupe_de_competences');
    }
}
