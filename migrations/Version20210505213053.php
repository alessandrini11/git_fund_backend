<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210505213053 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE depot (id INT AUTO_INCREMENT NOT NULL, adherents_id INT DEFAULT NULL, somme_id INT DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_47948BBC15364D07 (adherents_id), INDEX IDX_47948BBC7A33C17D (somme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE depot ADD CONSTRAINT FK_47948BBC15364D07 FOREIGN KEY (adherents_id) REFERENCES adherent (id)');
        $this->addSql('ALTER TABLE depot ADD CONSTRAINT FK_47948BBC7A33C17D FOREIGN KEY (somme_id) REFERENCES somme (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE depot');
    }
}
