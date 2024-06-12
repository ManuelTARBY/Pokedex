<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240610084133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ability (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, hidden TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE ability_pokemon (ability_id INT NOT NULL, pokemon_id INT NOT NULL, INDEX IDX_1E1671618016D8B2 (ability_id), INDEX IDX_1E1671612FE71C3E (pokemon_id), PRIMARY KEY(ability_id, pokemon_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE caught (id INT AUTO_INCREMENT NOT NULL, date_capture DATE NOT NULL, pokemon_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_70C55B2B2FE71C3E (pokemon_id), INDEX IDX_70C55B2BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE generation (id INT AUTO_INCREMENT NOT NULL, number INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE pokemon (id INT AUTO_INCREMENT NOT NULL, pokedex_id INT NOT NULL, category VARCHAR(45) NOT NULL, name_fr VARCHAR(100) NOT NULL, name_en VARCHAR(100) NOT NULL, name_jp VARCHAR(100) NOT NULL, sprite_regular LONGTEXT NOT NULL, sprite_shiny LONGTEXT NOT NULL, hp INT NOT NULL, atk INT NOT NULL, def INT NOT NULL, spe_atk INT NOT NULL, spe_def INT NOT NULL, vit INT NOT NULL, height VARCHAR(10) NOT NULL, weight VARCHAR(10) NOT NULL, generation_id INT NOT NULL, INDEX IDX_62DC90F3553A6EC4 (generation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE pokemon_pokemon (pokemon_source INT NOT NULL, pokemon_target INT NOT NULL, INDEX IDX_EB6EC6233630327 (pokemon_source), INDEX IDX_EB6EC622A8653A8 (pokemon_target), PRIMARY KEY(pokemon_source, pokemon_target)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, user_id INT DEFAULT NULL, INDEX IDX_C4E0A61FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE team_pokemon (team_id INT NOT NULL, pokemon_id INT NOT NULL, INDEX IDX_9DA5E1C4296CD8AE (team_id), INDEX IDX_9DA5E1C42FE71C3E (pokemon_id), PRIMARY KEY(team_id, pokemon_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, logo LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE type_pokemon (type_id INT NOT NULL, pokemon_id INT NOT NULL, INDEX IDX_4AFDFF06C54C8C93 (type_id), INDEX IDX_4AFDFF062FE71C3E (pokemon_id), PRIMARY KEY(type_id, pokemon_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(45) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE ability_pokemon ADD CONSTRAINT FK_1E1671618016D8B2 FOREIGN KEY (ability_id) REFERENCES ability (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ability_pokemon ADD CONSTRAINT FK_1E1671612FE71C3E FOREIGN KEY (pokemon_id) REFERENCES pokemon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE caught ADD CONSTRAINT FK_70C55B2B2FE71C3E FOREIGN KEY (pokemon_id) REFERENCES pokemon (id)');
        $this->addSql('ALTER TABLE caught ADD CONSTRAINT FK_70C55B2BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE pokemon ADD CONSTRAINT FK_62DC90F3553A6EC4 FOREIGN KEY (generation_id) REFERENCES generation (id)');
        $this->addSql('ALTER TABLE pokemon_pokemon ADD CONSTRAINT FK_EB6EC6233630327 FOREIGN KEY (pokemon_source) REFERENCES pokemon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pokemon_pokemon ADD CONSTRAINT FK_EB6EC622A8653A8 FOREIGN KEY (pokemon_target) REFERENCES pokemon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE team_pokemon ADD CONSTRAINT FK_9DA5E1C4296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_pokemon ADD CONSTRAINT FK_9DA5E1C42FE71C3E FOREIGN KEY (pokemon_id) REFERENCES pokemon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_pokemon ADD CONSTRAINT FK_4AFDFF06C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_pokemon ADD CONSTRAINT FK_4AFDFF062FE71C3E FOREIGN KEY (pokemon_id) REFERENCES pokemon (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ability_pokemon DROP FOREIGN KEY FK_1E1671618016D8B2');
        $this->addSql('ALTER TABLE ability_pokemon DROP FOREIGN KEY FK_1E1671612FE71C3E');
        $this->addSql('ALTER TABLE caught DROP FOREIGN KEY FK_70C55B2B2FE71C3E');
        $this->addSql('ALTER TABLE caught DROP FOREIGN KEY FK_70C55B2BA76ED395');
        $this->addSql('ALTER TABLE pokemon DROP FOREIGN KEY FK_62DC90F3553A6EC4');
        $this->addSql('ALTER TABLE pokemon_pokemon DROP FOREIGN KEY FK_EB6EC6233630327');
        $this->addSql('ALTER TABLE pokemon_pokemon DROP FOREIGN KEY FK_EB6EC622A8653A8');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61FA76ED395');
        $this->addSql('ALTER TABLE team_pokemon DROP FOREIGN KEY FK_9DA5E1C4296CD8AE');
        $this->addSql('ALTER TABLE team_pokemon DROP FOREIGN KEY FK_9DA5E1C42FE71C3E');
        $this->addSql('ALTER TABLE type_pokemon DROP FOREIGN KEY FK_4AFDFF06C54C8C93');
        $this->addSql('ALTER TABLE type_pokemon DROP FOREIGN KEY FK_4AFDFF062FE71C3E');
        $this->addSql('DROP TABLE ability');
        $this->addSql('DROP TABLE ability_pokemon');
        $this->addSql('DROP TABLE caught');
        $this->addSql('DROP TABLE generation');
        $this->addSql('DROP TABLE pokemon');
        $this->addSql('DROP TABLE pokemon_pokemon');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE team_pokemon');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE type_pokemon');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
