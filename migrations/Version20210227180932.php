<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210227180932 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE llibre ADD editorial_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE llibre ADD CONSTRAINT FK_BF9ADDAA4888C7F8 FOREIGN KEY (editorial_id_id) REFERENCES editorial (id)');
        $this->addSql('CREATE INDEX IDX_BF9ADDAA4888C7F8 ON llibre (editorial_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE llibre DROP FOREIGN KEY FK_BF9ADDAA4888C7F8');
        $this->addSql('DROP INDEX IDX_BF9ADDAA4888C7F8 ON llibre');
        $this->addSql('ALTER TABLE llibre DROP editorial_id_id');
    }
}
