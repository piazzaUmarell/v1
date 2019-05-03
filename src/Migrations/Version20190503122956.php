<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190503122956 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE refresh_tokens (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid DATETIME NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9BACE7E1C74F2195 ON refresh_tokens (refresh_token)');
        $this->addSql('DROP INDEX IDX_1A725CA412469DE2');
        $this->addSql('DROP INDEX IDX_1A725CA4362B62A0');
        $this->addSql('CREATE TEMPORARY TABLE __temp__category_episode AS SELECT category_id, episode_id FROM category_episode');
        $this->addSql('DROP TABLE category_episode');
        $this->addSql('CREATE TABLE category_episode (category_id INTEGER NOT NULL, episode_id INTEGER NOT NULL, PRIMARY KEY(category_id, episode_id), CONSTRAINT FK_1A725CA412469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1A725CA4362B62A0 FOREIGN KEY (episode_id) REFERENCES episode (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO category_episode (category_id, episode_id) SELECT category_id, episode_id FROM __temp__category_episode');
        $this->addSql('DROP TABLE __temp__category_episode');
        $this->addSql('CREATE INDEX IDX_1A725CA412469DE2 ON category_episode (category_id)');
        $this->addSql('CREATE INDEX IDX_1A725CA4362B62A0 ON category_episode (episode_id)');
        $this->addSql('DROP INDEX slug_idx');
        $this->addSql('DROP INDEX IDX_DDAA1CDA5278319C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__episode AS SELECT id, series_id, title, number, abstract, description, publication_date, source, slug, duration FROM episode');
        $this->addSql('DROP TABLE episode');
        $this->addSql('CREATE TABLE episode (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, series_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, number NUMERIC(10, 2) DEFAULT NULL, abstract CLOB NOT NULL COLLATE BINARY, description CLOB NOT NULL COLLATE BINARY, publication_date DATETIME DEFAULT NULL, source VARCHAR(255) NOT NULL COLLATE BINARY, slug VARCHAR(255) NOT NULL COLLATE BINARY, duration VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_DDAA1CDA5278319C FOREIGN KEY (series_id) REFERENCES series (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO episode (id, series_id, title, number, abstract, description, publication_date, source, slug, duration) SELECT id, series_id, title, number, abstract, description, publication_date, source, slug, duration FROM __temp__episode');
        $this->addSql('DROP TABLE __temp__episode');
        $this->addSql('CREATE UNIQUE INDEX slug_idx ON episode (slug)');
        $this->addSql('CREATE INDEX IDX_DDAA1CDA5278319C ON episode (series_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE refresh_tokens');
        $this->addSql('DROP INDEX IDX_1A725CA412469DE2');
        $this->addSql('DROP INDEX IDX_1A725CA4362B62A0');
        $this->addSql('CREATE TEMPORARY TABLE __temp__category_episode AS SELECT category_id, episode_id FROM category_episode');
        $this->addSql('DROP TABLE category_episode');
        $this->addSql('CREATE TABLE category_episode (category_id INTEGER NOT NULL, episode_id INTEGER NOT NULL, PRIMARY KEY(category_id, episode_id))');
        $this->addSql('INSERT INTO category_episode (category_id, episode_id) SELECT category_id, episode_id FROM __temp__category_episode');
        $this->addSql('DROP TABLE __temp__category_episode');
        $this->addSql('CREATE INDEX IDX_1A725CA412469DE2 ON category_episode (category_id)');
        $this->addSql('CREATE INDEX IDX_1A725CA4362B62A0 ON category_episode (episode_id)');
        $this->addSql('DROP INDEX IDX_DDAA1CDA5278319C');
        $this->addSql('DROP INDEX slug_idx');
        $this->addSql('CREATE TEMPORARY TABLE __temp__episode AS SELECT id, series_id, title, slug, number, abstract, description, publication_date, source, duration FROM episode');
        $this->addSql('DROP TABLE episode');
        $this->addSql('CREATE TABLE episode (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, series_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, number NUMERIC(10, 2) DEFAULT NULL, abstract CLOB NOT NULL, description CLOB NOT NULL, publication_date DATETIME DEFAULT NULL, source VARCHAR(255) NOT NULL, duration VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO episode (id, series_id, title, slug, number, abstract, description, publication_date, source, duration) SELECT id, series_id, title, slug, number, abstract, description, publication_date, source, duration FROM __temp__episode');
        $this->addSql('DROP TABLE __temp__episode');
        $this->addSql('CREATE INDEX IDX_DDAA1CDA5278319C ON episode (series_id)');
        $this->addSql('CREATE UNIQUE INDEX slug_idx ON episode (slug)');
    }
}