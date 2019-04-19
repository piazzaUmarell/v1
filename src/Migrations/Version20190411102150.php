<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190411102150 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE category_episode (category_id INTEGER NOT NULL, episode_id INTEGER NOT NULL, PRIMARY KEY(category_id, episode_id))');
        $this->addSql('CREATE INDEX IDX_1A725CA412469DE2 ON category_episode (category_id)');
        $this->addSql('CREATE INDEX IDX_1A725CA4362B62A0 ON category_episode (episode_id)');
        $this->addSql('CREATE TABLE series (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE episode (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, series_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, number NUMERIC(10, 2) DEFAULT NULL, abstract CLOB NOT NULL, description CLOB NOT NULL, publication_date DATETIME DEFAULT NULL, source VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_DDAA1CDA5278319C ON episode (series_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_episode');
        $this->addSql('DROP TABLE series');
        $this->addSql('DROP TABLE episode');
    }
}
