<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201202151311 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE groupe_tags_tags (groupe_tags_id INT NOT NULL, tags_id INT NOT NULL, INDEX IDX_308FEB414B1CA8FA (groupe_tags_id), INDEX IDX_308FEB418D7B4FB4 (tags_id), PRIMARY KEY(groupe_tags_id, tags_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE groupe_tags_tags ADD CONSTRAINT FK_308FEB414B1CA8FA FOREIGN KEY (groupe_tags_id) REFERENCES groupe_tags (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groupe_tags_tags ADD CONSTRAINT FK_308FEB418D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE niveau ADD groupe_actions VARCHAR(255) NOT NULL, ADD critere_evaluation VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE groupe_tags_tags');
        $this->addSql('ALTER TABLE niveau DROP groupe_actions, DROP critere_evaluation');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
    }
}
