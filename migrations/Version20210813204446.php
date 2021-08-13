<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210813204446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ext_log_entries (id INT AUTO_INCREMENT NOT NULL, action VARCHAR(8) NOT NULL, logged_at DATETIME NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(191) NOT NULL, version INT NOT NULL, data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', username VARCHAR(191) DEFAULT NULL, INDEX log_class_lookup_idx (object_class), INDEX log_date_lookup_idx (logged_at), INDEX log_user_lookup_idx (username), INDEX log_version_lookup_idx (object_id, object_class, version), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB ROW_FORMAT = DYNAMIC');
        $this->addSql('CREATE TABLE page (id INT UNSIGNED AUTO_INCREMENT NOT NULL, seo_id INT UNSIGNED DEFAULT NULL, position INT DEFAULT NULL, system_name VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, entity_class VARCHAR(255) NOT NULL, INDEX IDX_140AB62097E3DD86 (seo_id), INDEX system_name_idx (system_name), UNIQUE INDEX system_name_UNIQUE (system_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_translation (id INT UNSIGNED AUTO_INCREMENT NOT NULL, translatable_id INT UNSIGNED DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, locale VARCHAR(5) NOT NULL, entity_class VARCHAR(255) NOT NULL, INDEX IDX_A3D51B1D2C2AC5D3 (translatable_id), UNIQUE INDEX page_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seo (id INT UNSIGNED AUTO_INCREMENT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seo_pattern (id INT UNSIGNED AUTO_INCREMENT NOT NULL, system_name VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX system_name_idx (system_name), UNIQUE INDEX system_name_UNIQUE (system_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seo_pattern_translation (id INT UNSIGNED AUTO_INCREMENT NOT NULL, translatable_id INT UNSIGNED DEFAULT NULL, title_pattern VARCHAR(255) NOT NULL, description_pattern LONGTEXT DEFAULT NULL, locale VARCHAR(5) NOT NULL, INDEX IDX_FECDF6792C2AC5D3 (translatable_id), UNIQUE INDEX seo_pattern_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seo_translation (id INT UNSIGNED AUTO_INCREMENT NOT NULL, translatable_id INT UNSIGNED DEFAULT NULL, meta_title LONGTEXT DEFAULT NULL, og_title LONGTEXT DEFAULT NULL, h1 LONGTEXT DEFAULT NULL, breadcrumb LONGTEXT DEFAULT NULL, meta_description LONGTEXT DEFAULT NULL, og_description LONGTEXT DEFAULT NULL, meta_keyword LONGTEXT DEFAULT NULL, og_image LONGTEXT DEFAULT NULL, temp_og_image LONGTEXT DEFAULT NULL, locale VARCHAR(5) NOT NULL, INDEX IDX_700E6CE32C2AC5D3 (translatable_id), UNIQUE INDEX seo_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB62097E3DD86 FOREIGN KEY (seo_id) REFERENCES seo (id)');
        $this->addSql('ALTER TABLE page_translation ADD CONSTRAINT FK_A3D51B1D2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE seo_pattern_translation ADD CONSTRAINT FK_FECDF6792C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES seo_pattern (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE seo_translation ADD CONSTRAINT FK_700E6CE32C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES seo (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page_translation DROP FOREIGN KEY FK_A3D51B1D2C2AC5D3');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB62097E3DD86');
        $this->addSql('ALTER TABLE seo_translation DROP FOREIGN KEY FK_700E6CE32C2AC5D3');
        $this->addSql('ALTER TABLE seo_pattern_translation DROP FOREIGN KEY FK_FECDF6792C2AC5D3');
        $this->addSql('DROP TABLE ext_log_entries');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE page_translation');
        $this->addSql('DROP TABLE seo');
        $this->addSql('DROP TABLE seo_pattern');
        $this->addSql('DROP TABLE seo_pattern_translation');
        $this->addSql('DROP TABLE seo_translation');
    }
}
