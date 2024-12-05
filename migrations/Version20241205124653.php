<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241205124653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sticker (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, filename VARCHAR(255) NOT NULL, mood VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sticker_tags (sticker_id INT NOT NULL, tags_id INT NOT NULL, INDEX IDX_C8B846844D965A4D (sticker_id), INDEX IDX_C8B846848D7B4FB4 (tags_id), PRIMARY KEY(sticker_id, tags_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sticker_tags ADD CONSTRAINT FK_C8B846844D965A4D FOREIGN KEY (sticker_id) REFERENCES sticker (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sticker_tags ADD CONSTRAINT FK_C8B846848D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE messages ADD sticker_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E964D965A4D FOREIGN KEY (sticker_id) REFERENCES sticker (id)');
        $this->addSql('CREATE INDEX IDX_DB021E964D965A4D ON messages (sticker_id)');
        $this->addSql('DROP INDEX UNIQ_IDENTIFIER_EMAIL ON user');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E964D965A4D');
        $this->addSql('ALTER TABLE sticker_tags DROP FOREIGN KEY FK_C8B846844D965A4D');
        $this->addSql('ALTER TABLE sticker_tags DROP FOREIGN KEY FK_C8B846848D7B4FB4');
        $this->addSql('DROP TABLE sticker');
        $this->addSql('DROP TABLE sticker_tags');
        $this->addSql('DROP TABLE tags');
        $this->addSql('DROP INDEX IDX_DB021E964D965A4D ON messages');
        $this->addSql('ALTER TABLE messages DROP sticker_id');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user (email)');
    }
}
