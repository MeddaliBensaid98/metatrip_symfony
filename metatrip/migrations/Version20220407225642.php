<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220407225642 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE localisationvoyage (Idlocalisation INT AUTO_INCREMENT NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, idv INT DEFAULT NULL, INDEX idv (idv), PRIMARY KEY(Idlocalisation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abonnement DROP FOREIGN KEY FK_pai');
        $this->addSql('DROP INDEX FK_pai ON abonnement');
        $this->addSql('ALTER TABLE abonnement ADD Ref_paiment INT DEFAULT 1 NOT NULL, DROP Ref_paiement, CHANGE Prix_a Prix_a VARCHAR(110) NOT NULL');
        $this->addSql('CREATE INDEX FK_pai ON abonnement (Ref_paiment)');
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY fk_hot');
        $this->addSql('ALTER TABLE chambre DROP prixc, CHANGE idh idh INT DEFAULT NULL, CHANGE image image VARCHAR(40) NOT NULL, CHANGE etat etat VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FFFABF6E74 FOREIGN KEY (idh) REFERENCES hotel (Idh)');
        $this->addSql('ALTER TABLE chauffeur CHANGE etatDispo etatDispo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE hotel CHANGE image image VARCHAR(40) NOT NULL');
        $this->addSql('ALTER TABLE paiement CHANGE Ref_paiement Ref_paiement INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE reservation_event DROP FOREIGN KEY Fk_eve');
        $this->addSql('ALTER TABLE reservation_event DROP FOREIGN KEY Fk_usr');
        $this->addSql('ALTER TABLE reservation_hotel DROP FOREIGN KEY FK_u');
        $this->addSql('ALTER TABLE reservation_hotel DROP FOREIGN KEY kk_h');
        $this->addSql('DROP INDEX kk_h ON reservation_hotel');
        $this->addSql('ALTER TABLE reservation_hotel CHANGE idh idc INT NOT NULL');
        $this->addSql('CREATE INDEX fk_chh ON reservation_hotel (idc)');
        $this->addSql('ALTER TABLE reservation_voiture DROP FOREIGN KEY FK_CHAUFF');
        $this->addSql('ALTER TABLE reservation_voiture DROP FOREIGN KEY FK_resv');
        $this->addSql('ALTER TABLE reservation_voiture DROP FOREIGN KEY FK_resu');
        $this->addSql('ALTER TABLE reservation_voyage DROP FOREIGN KEY FK_resvoy');
        $this->addSql('ALTER TABLE reservation_voyage CHANGE Idu Idu INT DEFAULT NULL, CHANGE Idv Idv INT DEFAULT NULL, CHANGE Ref_paiement Ref_paiement INT NOT NULL');
        $this->addSql('ALTER TABLE sponsor DROP FOREIGN KEY sponsor_ibfk_1');
        $this->addSql('ALTER TABLE user CHANGE Image Image VARCHAR(1000) NOT NULL, CHANGE Role Role INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voiture ADD type VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE voyage_organise DROP FOREIGN KEY FK_vo');
        $this->addSql('ALTER TABLE voyage_organise CHANGE etatVoyage etatVoyage VARCHAR(255) DEFAULT \'INDISPO\' NOT NULL, CHANGE nbplaces nbplaces INT NOT NULL, CHANGE Idv Idv INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voyage_virtuel DROP FOREIGN KEY FK_abb');
        $this->addSql('ALTER TABLE voyage_virtuel DROP FOREIGN KEY FK_vv');
        $this->addSql('ALTER TABLE voyage_virtuel ADD Nom VARCHAR(255) NOT NULL, CHANGE Video Video VARCHAR(255) NOT NULL, CHANGE Image_v Image_v VARCHAR(255) NOT NULL, CHANGE Idv Idv INT DEFAULT NULL, CHANGE Ida Ida INT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX Idvv ON voyage_virtuel (Idvv)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE localisationvoyage');
        $this->addSql('DROP INDEX FK_pai ON abonnement');
        $this->addSql('ALTER TABLE abonnement ADD Ref_paiement INT NOT NULL, DROP Ref_paiment, CHANGE Prix_a Prix_a INT NOT NULL');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_pai FOREIGN KEY (Ref_paiement) REFERENCES paiement (Ref_paiement)');
        $this->addSql('CREATE INDEX FK_pai ON abonnement (Ref_paiement)');
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FFFABF6E74');
        $this->addSql('ALTER TABLE chambre ADD prixc DOUBLE PRECISION DEFAULT NULL, CHANGE idh idh INT NOT NULL, CHANGE image image VARCHAR(1000) NOT NULL, CHANGE etat etat VARCHAR(40) NOT NULL');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT fk_hot FOREIGN KEY (idh) REFERENCES hotel (Idh) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chauffeur CHANGE etatDispo etatDispo VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE hotel CHANGE image image VARCHAR(200) NOT NULL');
        $this->addSql('ALTER TABLE paiement CHANGE Ref_paiement Ref_paiement INT NOT NULL');
        $this->addSql('ALTER TABLE reservation_event ADD CONSTRAINT Fk_eve FOREIGN KEY (Ide) REFERENCES evenement (Ide) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_event ADD CONSTRAINT Fk_usr FOREIGN KEY (Idu) REFERENCES user (Idu) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP INDEX fk_chh ON reservation_hotel');
        $this->addSql('ALTER TABLE reservation_hotel CHANGE idc idh INT NOT NULL');
        $this->addSql('ALTER TABLE reservation_hotel ADD CONSTRAINT FK_u FOREIGN KEY (Idu) REFERENCES user (Idu) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_hotel ADD CONSTRAINT kk_h FOREIGN KEY (idh) REFERENCES hotel (Idh)');
        $this->addSql('CREATE INDEX kk_h ON reservation_hotel (idh)');
        $this->addSql('ALTER TABLE reservation_voiture ADD CONSTRAINT FK_CHAUFF FOREIGN KEY (idch) REFERENCES chauffeur (idch) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_voiture ADD CONSTRAINT FK_resv FOREIGN KEY (Idvoit) REFERENCES voiture (Idvoit) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_voiture ADD CONSTRAINT FK_resu FOREIGN KEY (Idu) REFERENCES user (Idu) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_voyage CHANGE Idu Idu INT NOT NULL, CHANGE Idv Idv INT NOT NULL, CHANGE Ref_paiement Ref_paiement INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE reservation_voyage ADD CONSTRAINT FK_resvoy FOREIGN KEY (Idv) REFERENCES voyage (Idv) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sponsor ADD CONSTRAINT sponsor_ibfk_1 FOREIGN KEY (ide) REFERENCES evenement (Ide) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user CHANGE Image Image VARCHAR(40) NOT NULL, CHANGE Role Role INT DEFAULT 0');
        $this->addSql('ALTER TABLE voiture DROP type');
        $this->addSql('ALTER TABLE voyage_organise CHANGE etatVoyage etatVoyage VARCHAR(255) NOT NULL, CHANGE nbplaces nbplaces INT DEFAULT NULL, CHANGE Idv Idv INT NOT NULL');
        $this->addSql('ALTER TABLE voyage_organise ADD CONSTRAINT FK_vo FOREIGN KEY (Idv) REFERENCES voyage (Idv) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP INDEX Idvv ON voyage_virtuel');
        $this->addSql('ALTER TABLE voyage_virtuel DROP Nom, CHANGE Image_v Image_v VARCHAR(50) NOT NULL, CHANGE Idv Idv INT NOT NULL, CHANGE Ida Ida INT NOT NULL, CHANGE Video Video VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE voyage_virtuel ADD CONSTRAINT FK_abb FOREIGN KEY (Ida) REFERENCES abonnement (Ida) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage_virtuel ADD CONSTRAINT FK_vv FOREIGN KEY (Idv) REFERENCES voyage (Idv) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
