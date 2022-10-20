<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221011220248 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_ECEA6D239D32F035');
        $this->addSql('DROP INDEX IDX_ECEA6D23D60322AC');
        $this->addSql('CREATE TEMPORARY TABLE __temp__role_action AS SELECT role_id, action_id FROM role_action');
        $this->addSql('DROP TABLE role_action');
        $this->addSql('CREATE TABLE role_action (role_id INTEGER NOT NULL, action_id INTEGER NOT NULL, PRIMARY KEY(role_id, action_id), CONSTRAINT FK_ECEA6D23D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_ECEA6D239D32F035 FOREIGN KEY (action_id) REFERENCES "action" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO role_action (role_id, action_id) SELECT role_id, action_id FROM __temp__role_action');
        $this->addSql('DROP TABLE __temp__role_action');
        $this->addSql('CREATE INDEX IDX_ECEA6D239D32F035 ON role_action (action_id)');
        $this->addSql('CREATE INDEX IDX_ECEA6D23D60322AC ON role_action (role_id)');
        $this->addSql('DROP INDEX IDX_8D93D649D60322AC');
        $this->addSql('DROP INDEX IDX_8D93D649DE2A7A37');
        $this->addSql('DROP INDEX IDX_8D93D649642B8210');
        $this->addSql('DROP INDEX UNIQ_8D93D64986CC499D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, admin_id, parrain_id, role_id, pseudo, roles, password, username, address, phone_number, image, created_at, updated_at, is_locked, locked_at FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, admin_id INTEGER DEFAULT NULL, parrain_id INTEGER DEFAULT NULL, role_id INTEGER NOT NULL, pseudo VARCHAR(100) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) DEFAULT NULL, username VARCHAR(150) NOT NULL, address VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(18) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , is_locked BOOLEAN NOT NULL, locked_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_8D93D649642B8210 FOREIGN KEY (admin_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8D93D649DE2A7A37 FOREIGN KEY (parrain_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user (id, admin_id, parrain_id, role_id, pseudo, roles, password, username, address, phone_number, image, created_at, updated_at, is_locked, locked_at) SELECT id, admin_id, parrain_id, role_id, pseudo, roles, password, username, address, phone_number, image, created_at, updated_at, is_locked, locked_at FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE INDEX IDX_8D93D649D60322AC ON user (role_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649DE2A7A37 ON user (parrain_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649642B8210 ON user (admin_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64986CC499D ON user (pseudo)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_ECEA6D23D60322AC');
        $this->addSql('DROP INDEX IDX_ECEA6D239D32F035');
        $this->addSql('CREATE TEMPORARY TABLE __temp__role_action AS SELECT role_id, action_id FROM role_action');
        $this->addSql('DROP TABLE role_action');
        $this->addSql('CREATE TABLE role_action (role_id INTEGER NOT NULL, action_id INTEGER NOT NULL, PRIMARY KEY(role_id, action_id))');
        $this->addSql('INSERT INTO role_action (role_id, action_id) SELECT role_id, action_id FROM __temp__role_action');
        $this->addSql('DROP TABLE __temp__role_action');
        $this->addSql('CREATE INDEX IDX_ECEA6D23D60322AC ON role_action (role_id)');
        $this->addSql('CREATE INDEX IDX_ECEA6D239D32F035 ON role_action (action_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D64986CC499D');
        $this->addSql('DROP INDEX IDX_8D93D649642B8210');
        $this->addSql('DROP INDEX IDX_8D93D649DE2A7A37');
        $this->addSql('DROP INDEX IDX_8D93D649D60322AC');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, admin_id, parrain_id, role_id, pseudo, roles, password, username, address, phone_number, image, created_at, updated_at, is_locked, locked_at FROM "user"');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('CREATE TABLE "user" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, admin_id INTEGER DEFAULT NULL, parrain_id INTEGER DEFAULT NULL, role_id INTEGER NOT NULL, pseudo VARCHAR(100) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) DEFAULT NULL, username VARCHAR(150) NOT NULL, address VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(18) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , is_locked BOOLEAN NOT NULL, locked_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO "user" (id, admin_id, parrain_id, role_id, pseudo, roles, password, username, address, phone_number, image, created_at, updated_at, is_locked, locked_at) SELECT id, admin_id, parrain_id, role_id, pseudo, roles, password, username, address, phone_number, image, created_at, updated_at, is_locked, locked_at FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64986CC499D ON "user" (pseudo)');
        $this->addSql('CREATE INDEX IDX_8D93D649642B8210 ON "user" (admin_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649DE2A7A37 ON "user" (parrain_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649D60322AC ON "user" (role_id)');
    }
}
