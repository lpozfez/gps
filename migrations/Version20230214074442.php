<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230214074442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE banda (id INT AUTO_INCREMENT NOT NULL, mensaje_id INT DEFAULT NULL, min INT NOT NULL, max INT NOT NULL, INDEX IDX_DF275A114C54F362 (mensaje_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mensaje (id INT AUTO_INCREMENT NOT NULL, fecha DATETIME NOT NULL, validado TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modo (id INT AUTO_INCREMENT NOT NULL, mensaje_id INT DEFAULT NULL, nombre VARCHAR(50) NOT NULL, INDEX IDX_771FAEB54C54F362 (mensaje_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE banda ADD CONSTRAINT FK_DF275A114C54F362 FOREIGN KEY (mensaje_id) REFERENCES mensaje (id)');
        $this->addSql('ALTER TABLE modo ADD CONSTRAINT FK_771FAEB54C54F362 FOREIGN KEY (mensaje_id) REFERENCES mensaje (id)');
        $this->addSql('ALTER TABLE user ADD mensaje_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6494C54F362 FOREIGN KEY (mensaje_id) REFERENCES mensaje (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6494C54F362 ON user (mensaje_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6494C54F362');
        $this->addSql('ALTER TABLE banda DROP FOREIGN KEY FK_DF275A114C54F362');
        $this->addSql('ALTER TABLE modo DROP FOREIGN KEY FK_771FAEB54C54F362');
        $this->addSql('DROP TABLE banda');
        $this->addSql('DROP TABLE mensaje');
        $this->addSql('DROP TABLE modo');
        $this->addSql('DROP INDEX IDX_8D93D6494C54F362 ON user');
        $this->addSql('ALTER TABLE user DROP mensaje_id');
    }
}
