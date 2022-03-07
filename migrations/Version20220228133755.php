<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220228133755 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE student DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE student ADD nsc INT NOT NULL, DROP id');
        $this->addSql('ALTER TABLE student ADD PRIMARY KEY (nsc)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classroom CHANGE nom nom VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nom1 nom1 VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nom2 nom2 VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE student ADD id INT AUTO_INCREMENT NOT NULL, DROP nsc, CHANGE email email VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
