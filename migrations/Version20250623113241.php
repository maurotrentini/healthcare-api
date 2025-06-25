<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250623113241 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE appointment ADD doctor_id INT DEFAULT NULL, ADD patient_id INT DEFAULT NULL, ADD clinic_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE appointment ADD CONSTRAINT FK_FE38F84487F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE appointment ADD CONSTRAINT FK_FE38F8446B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844CC22AD4 FOREIGN KEY (clinic_id) REFERENCES clinic (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_FE38F84487F4FB17 ON appointment (doctor_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_FE38F8446B899279 ON appointment (patient_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_FE38F844CC22AD4 ON appointment (clinic_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE doctor ADD clinic_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE doctor ADD CONSTRAINT FK_1FC0F36ACC22AD4 FOREIGN KEY (clinic_id) REFERENCES clinic (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_1FC0F36ACC22AD4 ON doctor (clinic_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F84487F4FB17
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F8446B899279
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F844CC22AD4
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_FE38F84487F4FB17 ON appointment
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_FE38F8446B899279 ON appointment
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_FE38F844CC22AD4 ON appointment
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE appointment DROP doctor_id, DROP patient_id, DROP clinic_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE doctor DROP FOREIGN KEY FK_1FC0F36ACC22AD4
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_1FC0F36ACC22AD4 ON doctor
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE doctor DROP clinic_id
        SQL);
    }
}
