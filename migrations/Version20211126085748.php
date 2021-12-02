<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211126085748 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE depot (id INT AUTO_INCREMENT NOT NULL, capacite VARCHAR(255) NOT NULL, categorie VARCHAR(255) NOT NULL, localisation VARCHAR(255) NOT NULL, etat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE moyen_de_transport (id INT AUTO_INCREMENT NOT NULL, depot_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, num_ligne VARCHAR(255) NOT NULL, date_de_mise_en_circulation DATE NOT NULL, etat VARCHAR(255) NOT NULL, accessible_au_handicape VARCHAR(255) NOT NULL, prix_achat DOUBLE PRECISION NOT NULL, poids DOUBLE PRECISION NOT NULL, longueur DOUBLE PRECISION NOT NULL, largeur DOUBLE PRECISION NOT NULL, energie VARCHAR(255) NOT NULL, nombre_de_place INT NOT NULL, INDEX IDX_1E6E57278510D4DE (depot_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE moyen_de_transport ADD CONSTRAINT FK_1E6E57278510D4DE FOREIGN KEY (depot_id) REFERENCES depot (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE moyen_de_transport DROP FOREIGN KEY FK_1E6E57278510D4DE');
        $this->addSql('DROP TABLE depot');
        $this->addSql('DROP TABLE moyen_de_transport');
    }
}
