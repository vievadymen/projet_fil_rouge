<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201206204249 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brief (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, date DATE NOT NULL, enonce VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promos (id INT AUTO_INCREMENT NOT NULL, langue VARCHAR(100) NOT NULL, titre VARCHAR(255) NOT NULL, lieu_promo VARCHAR(255) NOT NULL, date_fin DATE NOT NULL, date_debut DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promos_referentiel (promos_id INT NOT NULL, referentiel_id INT NOT NULL, INDEX IDX_5813A7CECAA392D2 (promos_id), INDEX IDX_5813A7CE805DB139 (referentiel_id), PRIMARY KEY(promos_id, referentiel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE promos_referentiel ADD CONSTRAINT FK_5813A7CECAA392D2 FOREIGN KEY (promos_id) REFERENCES promos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE promos_referentiel ADD CONSTRAINT FK_5813A7CE805DB139 FOREIGN KEY (referentiel_id) REFERENCES referentiel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groupe ADD promos_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT FK_4B98C21CAA392D2 FOREIGN KEY (promos_id) REFERENCES promos (id)');
        $this->addSql('CREATE INDEX IDX_4B98C21CAA392D2 ON groupe (promos_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE groupe DROP FOREIGN KEY FK_4B98C21CAA392D2');
        $this->addSql('ALTER TABLE promos_referentiel DROP FOREIGN KEY FK_5813A7CECAA392D2');
        $this->addSql('DROP TABLE brief');
        $this->addSql('DROP TABLE promos');
        $this->addSql('DROP TABLE promos_referentiel');
        $this->addSql('DROP INDEX IDX_4B98C21CAA392D2 ON groupe');
        $this->addSql('ALTER TABLE groupe DROP promos_id');
    }
}
