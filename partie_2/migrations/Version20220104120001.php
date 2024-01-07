<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220104120001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creation table mail contact';
    }

    public function up(Schema $schema): void
    {
        // Create MailContact table
        $this->addSql('CREATE TABLE mail_contact (id INT AUTO_INCREMENT NOT NULL, date_envoi DATETIME DEFAULT NULL, objet VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, expediteur_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_ABCDEFGH ON mail_contact (expediteur_id)');
        $this->addSql('ALTER TABLE mail_contact ADD CONSTRAINT FK_ABCDEFGH FOREIGN KEY (expediteur_id) REFERENCES educateur (id)');

        // Create association table
        $this->addSql('CREATE TABLE mail_educateur_contact (mail_contact_id INT NOT NULL, contact_id INT NOT NULL, PRIMARY KEY(mail_contact_id, contact_id))');
        $this->addSql('CREATE INDEX IDX_123456789 ON mail_educateur_contact (mail_contact_id)');
        $this->addSql('CREATE INDEX IDX_ABCDEFGHI ON mail_educateur_contact (contact_id)');
        $this->addSql('ALTER TABLE mail_educateur_contact ADD CONSTRAINT FK_123456789 FOREIGN KEY (mail_contact_id) REFERENCES mail_contact (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mail_educateur_contact ADD CONSTRAINT FK_ABCDEFGHI FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // Drop association table
        $this->addSql('DROP TABLE mail_educateur_contact');

        // Drop MailContact table
        $this->addSql('DROP TABLE mail_contact');
    }
}
