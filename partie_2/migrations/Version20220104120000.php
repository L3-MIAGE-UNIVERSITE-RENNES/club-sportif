<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220104120000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creation table mail educateur';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mail_educateur (
            id INT AUTO_INCREMENT NOT NULL,
            date_envoi DATETIME DEFAULT NULL,
            objet VARCHAR(255) NOT NULL,
            message VARCHAR(255) NOT NULL,
            expediteur_id INT DEFAULT NULL,
            PRIMARY KEY(id),
            INDEX IDX_EA83F3814018F9C (expediteur_id),
            CONSTRAINT FK_EA83F3814018F9C FOREIGN KEY (expediteur_id) REFERENCES educateur (id) ON DELETE CASCADE
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE mail_educateur_educateur (
            mail_educateur_id INT NOT NULL,
            educateur_id INT NOT NULL,
            INDEX IDX_EA3E2A2E7C43913 (mail_educateur_id),
            INDEX IDX_EA3E2A2E74B64B64 (educateur_id),
            PRIMARY KEY(mail_educateur_id, educateur_id),
            CONSTRAINT FK_EA3E2A2E7C43913 FOREIGN KEY (mail_educateur_id) REFERENCES mail_educateur (id) ON DELETE CASCADE,
            CONSTRAINT FK_EA3E2A2E74B64B64 FOREIGN KEY (educateur_id) REFERENCES educateur (id) ON DELETE CASCADE
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE mail_educateur_educateur');
        $this->addSql('DROP TABLE mail_educateur');
    }
}
