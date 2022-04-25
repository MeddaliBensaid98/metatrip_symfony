<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220422172505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abonnement (Ida INT AUTO_INCREMENT NOT NULL, Type VARCHAR(20) NOT NULL, Prix_a INT NOT NULL, Date_achat DATE NOT NULL, Date_expiration DATE NOT NULL, Etat VARCHAR(20) NOT NULL, Ref_paiement INT DEFAULT NULL, INDEX Ida (Ida), INDEX FK_pai (Ref_paiement), PRIMARY KEY(Ida)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(40) NOT NULL, prenom VARCHAR(40) NOT NULL, email VARCHAR(255) NOT NULL, mdp VARCHAR(15) NOT NULL, numtel BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chambre (idc INT AUTO_INCREMENT NOT NULL, idh INT DEFAULT NULL, numc INT NOT NULL, image VARCHAR(1000) NOT NULL, type VARCHAR(20) NOT NULL, etat VARCHAR(40) NOT NULL, prixc DOUBLE PRECISION DEFAULT \'NULL\', INDEX idc (idc), INDEX idh (idh), PRIMARY KEY(idc)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chauffeur (idch INT AUTO_INCREMENT NOT NULL, nom VARCHAR(20) NOT NULL, prenom VARCHAR(20) NOT NULL, photo VARCHAR(20) NOT NULL, tel VARCHAR(20) NOT NULL, description VARCHAR(20) NOT NULL, etatDispo VARCHAR(20) NOT NULL, INDEX idch (idch), PRIMARY KEY(idch)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (cin BIGINT AUTO_INCREMENT NOT NULL, nomPrenom VARCHAR(30) NOT NULL, surnom VARCHAR(11) NOT NULL, Sexe VARCHAR(5) NOT NULL, email VARCHAR(40) NOT NULL, mdp VARCHAR(20) NOT NULL, dateNaissance DATE NOT NULL, adresse VARCHAR(11) NOT NULL, image VARCHAR(1000) NOT NULL, PRIMARY KEY(cin)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id_cmd INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, num_tel INT NOT NULL, codepostal INT NOT NULL, Etat VARCHAR(255) NOT NULL, adressmail VARCHAR(255) NOT NULL, mode_paiment VARCHAR(255) NOT NULL, PRIMARY KEY(id_cmd)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement (ref_equipement INT AUTO_INCREMENT NOT NULL, nom_equipement VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, prix_equipement DOUBLE PRECISION NOT NULL, description_equipement TEXT NOT NULL, PRIMARY KEY(ref_equipement)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (Ide INT AUTO_INCREMENT NOT NULL, Type_event VARCHAR(20) NOT NULL, Chanteur VARCHAR(20) NOT NULL, Adresse VARCHAR(20) NOT NULL, Date_event DATE NOT NULL, prix_e DOUBLE PRECISION NOT NULL, PRIMARY KEY(Ide)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hotel (Idh INT AUTO_INCREMENT NOT NULL, Nom_hotel VARCHAR(20) NOT NULL, Nb_etoiles INT NOT NULL, Adresse VARCHAR(50) NOT NULL, image VARCHAR(200) NOT NULL, PRIMARY KEY(Idh)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre (id_promotion INT AUTO_INCREMENT NOT NULL, ref_equipement INT DEFAULT NULL, date_debutpromo DATE NOT NULL, date_finpromo DATE NOT NULL, Pourcentagepromo VARCHAR(11) NOT NULL, INDEX ref_equipement (ref_equipement), PRIMARY KEY(id_promotion)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paiement (Ref_paiement INT AUTO_INCREMENT NOT NULL, Date_paiement DATE NOT NULL, PRIMARY KEY(Ref_paiement)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE panier (id_panier INT AUTO_INCREMENT NOT NULL, ref_equipement INT DEFAULT NULL, total_panier DOUBLE PRECISION NOT NULL, nbr_equipement INT NOT NULL, prix_equipement INT NOT NULL, Cin BIGINT DEFAULT NULL, INDEX eq (ref_equipement), INDEX eu (Cin), PRIMARY KEY(id_panier)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation (id_rec INT AUTO_INCREMENT NOT NULL, type_rec VARCHAR(255) NOT NULL, description_rec TEXT NOT NULL, date_rec DATE DEFAULT \'current_timestamp()\' NOT NULL, cin BIGINT NOT NULL, archived TINYINT(1) DEFAULT NULL, screenshot VARCHAR(500) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id_rec)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id_reservation INT AUTO_INCREMENT NOT NULL, cin BIGINT NOT NULL, date_reservation DATE NOT NULL, nbrPersonne INT NOT NULL, id_zoneCamping INT DEFAULT NULL, INDEX FK_rec_zoneC (id_zoneCamping), PRIMARY KEY(id_reservation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_event (Idrev INT AUTO_INCREMENT NOT NULL, Nb_pers INT NOT NULL, Ide INT DEFAULT NULL, Idu INT DEFAULT NULL, INDEX Idrev (Idrev), INDEX Fk_eve (Ide), INDEX Fk_usr (Idu), PRIMARY KEY(Idrev)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_hotel (idh INT DEFAULT NULL, Idrh INT AUTO_INCREMENT NOT NULL, Nb_nuitees INT NOT NULL, Nb_personnes INT NOT NULL, Prix DOUBLE PRECISION NOT NULL, Date_depart DATE DEFAULT \'NULL\', Date_arrivee DATE DEFAULT \'NULL\', Idu INT DEFAULT NULL, INDEX Idrh (Idrh), INDEX FK_u (Idu), INDEX kk_h (idh), PRIMARY KEY(Idrh)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_voiture (idch INT DEFAULT NULL, Idrvoit INT AUTO_INCREMENT NOT NULL, prix_rent DOUBLE PRECISION NOT NULL, Trajet VARCHAR(20) NOT NULL, Idvoit INT DEFAULT NULL, Idu INT DEFAULT NULL, INDEX FK_CHAUFF (idch), INDEX Idrvoit (Idrvoit), INDEX FK_resu (Idu), INDEX FK_resv (Idvoit), PRIMARY KEY(Idrvoit)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_voyage (Idrv INT AUTO_INCREMENT NOT NULL, Date_depart DATE NOT NULL, Date_arrivee DATE NOT NULL, etat VARCHAR(20) NOT NULL, Idu INT NOT NULL, Ref_paiement INT NOT NULL, Idv INT DEFAULT NULL, INDEX FK_resvoy (Idv), INDEX FK_reusr (Idu), INDEX Idrv (Idrv), INDEX FKPAY (Ref_paiement), PRIMARY KEY(Idrv)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sponsor (ids INT AUTO_INCREMENT NOT NULL, ide INT DEFAULT NULL, nomsponsor VARCHAR(20) NOT NULL, tel VARCHAR(20) NOT NULL, email VARCHAR(20) NOT NULL, date_sp DATE NOT NULL, prix_sp DOUBLE PRECISION NOT NULL, INDEX sponsor_ibfk_1 (ide), PRIMARY KEY(ids)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (Idu INT AUTO_INCREMENT NOT NULL, Cin VARCHAR(20) NOT NULL, Nom VARCHAR(20) NOT NULL, Prenom VARCHAR(20) NOT NULL, Tel VARCHAR(20) NOT NULL, Email VARCHAR(38) NOT NULL, Password VARCHAR(50) NOT NULL, Image VARCHAR(40) NOT NULL, Role INT DEFAULT NULL, dateNaissance DATE DEFAULT \'NULL\', PRIMARY KEY(Idu)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voiture (Idvoit INT AUTO_INCREMENT NOT NULL, Matricule VARCHAR(50) NOT NULL, Puissance_fiscalle INT NOT NULL, Image_v VARCHAR(50) NOT NULL, Modele VARCHAR(20) NOT NULL, INDEX Idvoit (Idvoit), PRIMARY KEY(Idvoit)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage (Idv INT AUTO_INCREMENT NOT NULL, Pays VARCHAR(20) NOT NULL, Image_pays VARCHAR(50) NOT NULL, PRIMARY KEY(Idv)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage_organise (Idvo INT AUTO_INCREMENT NOT NULL, Prix_billet DOUBLE PRECISION NOT NULL, Airline VARCHAR(20) NOT NULL, Nb_nuitees INT NOT NULL, nbplaces INT NOT NULL, etatVoyage VARCHAR(255) NOT NULL, Idv INT DEFAULT NULL, INDEX FK_vo (Idv), PRIMARY KEY(Idvo)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage_virtuel (Idvv INT AUTO_INCREMENT NOT NULL, Video VARCHAR(255) NOT NULL, Nom VARCHAR(255) NOT NULL, Image_v VARCHAR(255) NOT NULL, Ida INT DEFAULT NULL, Idv INT DEFAULT NULL, INDEX FK_abb (Ida), INDEX FK_vv (Idv), PRIMARY KEY(Idvv)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zonecamping (id INT AUTO_INCREMENT NOT NULL, region VARCHAR(255) NOT NULL, delegation VARCHAR(255) NOT NULL, nom_centre VARCHAR(255) NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE abonnement ADD CONSTRAINT FK_351268BB2FFA6761 FOREIGN KEY (Ref_paiement) REFERENCES paiement (Ref_paiement)');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FFFABF6E74 FOREIGN KEY (idh) REFERENCES hotel (Idh)');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866FBE7129ED FOREIGN KEY (ref_equipement) REFERENCES equipement (ref_equipement)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF293A8763A FOREIGN KEY (Cin) REFERENCES client (cin)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF2BE7129ED FOREIGN KEY (ref_equipement) REFERENCES equipement (ref_equipement)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495590263F7E FOREIGN KEY (id_zoneCamping) REFERENCES zonecamping (id)');
        $this->addSql('ALTER TABLE reservation_event ADD CONSTRAINT FK_78D1DA00BC435429 FOREIGN KEY (Ide) REFERENCES evenement (Ide)');
        $this->addSql('ALTER TABLE reservation_event ADD CONSTRAINT FK_78D1DA00A1F4444D FOREIGN KEY (Idu) REFERENCES user (Idu)');
        $this->addSql('ALTER TABLE reservation_hotel ADD CONSTRAINT FK_402C8E7EA1F4444D FOREIGN KEY (Idu) REFERENCES user (Idu)');
        $this->addSql('ALTER TABLE reservation_hotel ADD CONSTRAINT FK_402C8E7EFABF6E74 FOREIGN KEY (idh) REFERENCES hotel (Idh)');
        $this->addSql('ALTER TABLE reservation_voiture ADD CONSTRAINT FK_8E773A8A250DD567 FOREIGN KEY (idch) REFERENCES chauffeur (idch)');
        $this->addSql('ALTER TABLE reservation_voiture ADD CONSTRAINT FK_8E773A8A1BAF3D1C FOREIGN KEY (Idvoit) REFERENCES voiture (Idvoit)');
        $this->addSql('ALTER TABLE reservation_voiture ADD CONSTRAINT FK_8E773A8AA1F4444D FOREIGN KEY (Idu) REFERENCES user (Idu)');
        $this->addSql('ALTER TABLE reservation_voyage ADD CONSTRAINT FK_776CC0CE38FD15F7 FOREIGN KEY (Idv) REFERENCES voyage (Idv)');
        $this->addSql('ALTER TABLE sponsor ADD CONSTRAINT FK_818CC9D4840E12C9 FOREIGN KEY (ide) REFERENCES evenement (Ide)');
        $this->addSql('ALTER TABLE voyage_organise ADD CONSTRAINT FK_22CA7F3238FD15F7 FOREIGN KEY (Idv) REFERENCES voyage (Idv)');
        $this->addSql('ALTER TABLE voyage_virtuel ADD CONSTRAINT FK_A25D6187BB2E9030 FOREIGN KEY (Ida) REFERENCES abonnement (Ida)');
        $this->addSql('ALTER TABLE voyage_virtuel ADD CONSTRAINT FK_A25D618738FD15F7 FOREIGN KEY (Idv) REFERENCES voyage (Idv)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voyage_virtuel DROP FOREIGN KEY FK_A25D6187BB2E9030');
        $this->addSql('ALTER TABLE reservation_voiture DROP FOREIGN KEY FK_8E773A8A250DD567');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF293A8763A');
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866FBE7129ED');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF2BE7129ED');
        $this->addSql('ALTER TABLE reservation_event DROP FOREIGN KEY FK_78D1DA00BC435429');
        $this->addSql('ALTER TABLE sponsor DROP FOREIGN KEY FK_818CC9D4840E12C9');
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FFFABF6E74');
        $this->addSql('ALTER TABLE reservation_hotel DROP FOREIGN KEY FK_402C8E7EFABF6E74');
        $this->addSql('ALTER TABLE abonnement DROP FOREIGN KEY FK_351268BB2FFA6761');
        $this->addSql('ALTER TABLE reservation_event DROP FOREIGN KEY FK_78D1DA00A1F4444D');
        $this->addSql('ALTER TABLE reservation_hotel DROP FOREIGN KEY FK_402C8E7EA1F4444D');
        $this->addSql('ALTER TABLE reservation_voiture DROP FOREIGN KEY FK_8E773A8AA1F4444D');
        $this->addSql('ALTER TABLE reservation_voiture DROP FOREIGN KEY FK_8E773A8A1BAF3D1C');
        $this->addSql('ALTER TABLE reservation_voyage DROP FOREIGN KEY FK_776CC0CE38FD15F7');
        $this->addSql('ALTER TABLE voyage_organise DROP FOREIGN KEY FK_22CA7F3238FD15F7');
        $this->addSql('ALTER TABLE voyage_virtuel DROP FOREIGN KEY FK_A25D618738FD15F7');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495590263F7E');
        $this->addSql('DROP TABLE abonnement');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE chambre');
        $this->addSql('DROP TABLE chauffeur');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE hotel');
        $this->addSql('DROP TABLE offre');
        $this->addSql('DROP TABLE paiement');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE reservation_event');
        $this->addSql('DROP TABLE reservation_hotel');
        $this->addSql('DROP TABLE reservation_voiture');
        $this->addSql('DROP TABLE reservation_voyage');
        $this->addSql('DROP TABLE sponsor');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE voiture');
        $this->addSql('DROP TABLE voyage');
        $this->addSql('DROP TABLE voyage_organise');
        $this->addSql('DROP TABLE voyage_virtuel');
        $this->addSql('DROP TABLE zonecamping');
    }
}
