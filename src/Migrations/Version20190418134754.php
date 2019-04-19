<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190418134754 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE task_folder ADD folder_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE task_folder ADD CONSTRAINT FK_D70B8D1E162CB942 FOREIGN KEY (folder_id) REFERENCES task_folder (id)');
        $this->addSql('CREATE INDEX IDX_D70B8D1E162CB942 ON task_folder (folder_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE task_folder DROP FOREIGN KEY FK_D70B8D1E162CB942');
        $this->addSql('DROP INDEX IDX_D70B8D1E162CB942 ON task_folder');
        $this->addSql('ALTER TABLE task_folder DROP folder_id');
    }
}
