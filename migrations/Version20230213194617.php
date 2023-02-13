<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230213194617 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande CHANGE status status LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE repas DROP repas_dispo');
        $this->addSql('ALTER TABLE user CHANGE ville ville VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande CHANGE status status VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE repas ADD repas_dispo TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE `user` CHANGE ville ville VARCHAR(180) NOT NULL');
    }
}
