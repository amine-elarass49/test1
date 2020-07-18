<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200718192824 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE etat_produit (etat_id INT AUTO_INCREMENT NOT NULL, etat_libelle VARCHAR(255) NOT NULL, PRIMARY KEY(etat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gamme_produit (gam_id INT AUTO_INCREMENT NOT NULL, gam_libelle VARCHAR(255) NOT NULL, PRIMARY KEY(gam_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marque_produit (marque_id INT AUTO_INCREMENT NOT NULL, marque_libelle VARCHAR(255) NOT NULL, PRIMARY KEY(marque_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parametres (par_id INT AUTO_INCREMENT NOT NULL, pr_extension INT NOT NULL, par_param VARCHAR(255) NOT NULL, par_valeur VARCHAR(255) NOT NULL, INDEX IDX_1A79799DC87058B5 (pr_extension), PRIMARY KEY(par_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_extension (pr_ex_id INT AUTO_INCREMENT NOT NULL, produit INT NOT NULL, pr_ex_valeur VARCHAR(255) NOT NULL, INDEX IDX_1B20639B29A5EC27 (produit), PRIMARY KEY(pr_ex_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produits (pr_id INT AUTO_INCREMENT NOT NULL, etat INT NOT NULL, type INT NOT NULL, gamme INT NOT NULL, marque INT NOT NULL, pr_nom VARCHAR(255) NOT NULL, pr_ref VARCHAR(255) NOT NULL, pr_desc VARCHAR(255) NOT NULL, pr_image VARCHAR(255) NOT NULL, pr_desc_int VARCHAR(255) NOT NULL, INDEX IDX_BE2DDF8C55CAF762 (etat), INDEX IDX_BE2DDF8C8CDE5729 (type), INDEX IDX_BE2DDF8CC32E1468 (gamme), INDEX IDX_BE2DDF8C5A6F91CE (marque), PRIMARY KEY(pr_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produits_unite_mesure (produits_pr_id INT NOT NULL, unite_mesure_um_id INT NOT NULL, INDEX IDX_75F8E50612B117A9 (produits_pr_id), INDEX IDX_75F8E506ADBF56BF (unite_mesure_um_id), PRIMARY KEY(produits_pr_id, unite_mesure_um_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_produit (type_id INT AUTO_INCREMENT NOT NULL, type_libelle VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unite_mesure (um_id INT AUTO_INCREMENT NOT NULL, um_libelle VARCHAR(255) NOT NULL, PRIMARY KEY(um_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE parametres ADD CONSTRAINT FK_1A79799DC87058B5 FOREIGN KEY (pr_extension) REFERENCES produit_extension (pr_ex_id)');
        $this->addSql('ALTER TABLE produit_extension ADD CONSTRAINT FK_1B20639B29A5EC27 FOREIGN KEY (produit) REFERENCES produits (pr_id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C55CAF762 FOREIGN KEY (etat) REFERENCES etat_produit (etat_id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C8CDE5729 FOREIGN KEY (type) REFERENCES type_produit (type_id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8CC32E1468 FOREIGN KEY (gamme) REFERENCES gamme_produit (gam_id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C5A6F91CE FOREIGN KEY (marque) REFERENCES marque_produit (marque_id)');
        $this->addSql('ALTER TABLE produits_unite_mesure ADD CONSTRAINT FK_75F8E50612B117A9 FOREIGN KEY (produits_pr_id) REFERENCES produits (pr_id)');
        $this->addSql('ALTER TABLE produits_unite_mesure ADD CONSTRAINT FK_75F8E506ADBF56BF FOREIGN KEY (unite_mesure_um_id) REFERENCES unite_mesure (um_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C55CAF762');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8CC32E1468');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C5A6F91CE');
        $this->addSql('ALTER TABLE parametres DROP FOREIGN KEY FK_1A79799DC87058B5');
        $this->addSql('ALTER TABLE produit_extension DROP FOREIGN KEY FK_1B20639B29A5EC27');
        $this->addSql('ALTER TABLE produits_unite_mesure DROP FOREIGN KEY FK_75F8E50612B117A9');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C8CDE5729');
        $this->addSql('ALTER TABLE produits_unite_mesure DROP FOREIGN KEY FK_75F8E506ADBF56BF');
        $this->addSql('DROP TABLE etat_produit');
        $this->addSql('DROP TABLE gamme_produit');
        $this->addSql('DROP TABLE marque_produit');
        $this->addSql('DROP TABLE parametres');
        $this->addSql('DROP TABLE produit_extension');
        $this->addSql('DROP TABLE produits');
        $this->addSql('DROP TABLE produits_unite_mesure');
        $this->addSql('DROP TABLE type_produit');
        $this->addSql('DROP TABLE unite_mesure');
    }
}
