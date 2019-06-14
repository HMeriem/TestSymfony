<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190226155053 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE experience_pro_competence_pro');
        $this->addSql('DROP TABLE experience_pro_techno_pro');
        $this->addSql('ALTER TABLE techno_pro ADD experience_pro INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE experience_pro_competence_pro (experience_pro_id INT NOT NULL, competence_pro_id INT NOT NULL, INDEX IDX_CC2B6D9137000397 (experience_pro_id), INDEX IDX_CC2B6D918A5481A6 (competence_pro_id), PRIMARY KEY(experience_pro_id, competence_pro_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE experience_pro_techno_pro (experience_pro_id INT NOT NULL, techno_pro_id INT NOT NULL, INDEX IDX_6F9F39E437000397 (experience_pro_id), INDEX IDX_6F9F39E4F44CCB53 (techno_pro_id), PRIMARY KEY(experience_pro_id, techno_pro_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE experience_pro_competence_pro ADD CONSTRAINT FK_CC2B6D9137000397 FOREIGN KEY (experience_pro_id) REFERENCES experience_pro (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE experience_pro_competence_pro ADD CONSTRAINT FK_CC2B6D918A5481A6 FOREIGN KEY (competence_pro_id) REFERENCES competence_pro (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE experience_pro_techno_pro ADD CONSTRAINT FK_6F9F39E437000397 FOREIGN KEY (experience_pro_id) REFERENCES experience_pro (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE experience_pro_techno_pro ADD CONSTRAINT FK_6F9F39E4F44CCB53 FOREIGN KEY (techno_pro_id) REFERENCES techno_pro (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE techno_pro DROP experience_pro');
    }
}
