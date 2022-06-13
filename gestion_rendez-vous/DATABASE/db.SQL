CREATE DATABASE `gestion_rendez-vous`;
USE `gestion_rendez-vous`;

CREATE TABLE patient (
    num varchar(7) PRIMARY KEY NOT NULL,
    nom_pt varchar(55) NOT NULL,
    prenom_pt varchar(55) NOT NULL,
    tele_pt int(10) NOT NULL,
    email_pt varchar(75) NOT NULL,
    password_pt LONGTEXT NOT NULL,
    UNIQUE(num)
    );
    
CREATE TABLE médecin (
    id_mc int PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nom_mc varchar(55) NOT NULL,
    prenom_mc varchar(55) NOT NULL,
    tele_mc int(10) NOT NULL,
    email_mc varchar(65) NOT NULL,
    password_mc varchar(55) NOT NULL
    );
   
CREATE TABLE rdv (
    id_rdv int PRIMARY KEY AUTO_INCREMENT NOT NULL,
    date_rdv date NOT NULL,
    hour_debut time NOT NULL,
    hour_fin time NOT NULL,
    num_patient varchar(7) NOT NULL,
    id_médecin int NOT NULL,
    CONSTRAINT ky_pt_rdv FOREIGN KEY(num_patient) REFERENCES patient(num),
    CONSTRAINT ky_mc_rdv FOREIGN KEY(id_médecin) REFERENCES médecin(id_mc)
    );


--les médecins 
INSERT INTO `medecin` (`id_mc`, `prenom_mc`, `nom_mc`, `tele_mc`, `email_mc`, `password_mc`) 
VALUES  (NULL, 'Khalid', 'El Hassani', '612345678', 'test1@gmail.com', 'test111'),
        (null,'said', 'Chikhi', '623568945', 'test2@gmail.com', 'test222'),
        (NULL, 'Soumia', 'Elmelhaoui', '647483647', 'test3@gmail.com', 'test333'),
        (NULL, 'Mohamed', 'El Khayri', '625896312', 'test4@gmail.com', 'test444'),
        (NULL, 'Jamal', 'El Moussaoui', '632145698', 'test5@gmail.com', 'test555'),
        (NULL, 'Saad', 'Essadiki', '645874848', 'test6@gmail.com', 'test666');

--un patient pour teste
INSERT INTO `patient` (`num`, `nom_pt`, `prenom_pt`, `tele_pt`, `email_pt`, `password_pt`) 
VALUES ('RB12345', 'patient1', 'fasi', '0612365478', 'patient1@gmail.com', 'test111');
