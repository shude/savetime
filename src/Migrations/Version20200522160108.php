<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200522160108 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE file (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, hash VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image_file ADD file_id INT NOT NULL');
        $this->addSql('ALTER TABLE image_file ADD CONSTRAINT FK_7EA5DC8E93CB796C FOREIGN KEY (file_id) REFERENCES file (id)');
        $this->addSql('CREATE INDEX IDX_7EA5DC8E93CB796C ON image_file (file_id)');
        $this->addSql("CREATE INDEX file_hash ON file (hash(6));");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image_file DROP FOREIGN KEY FK_7EA5DC8E93CB796C');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP INDEX IDX_7EA5DC8E93CB796C ON image_file');
        $this->addSql('ALTER TABLE image_file DROP file_id');
    }
}
