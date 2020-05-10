
SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS zlodej;
DROP TABLE IF EXISTS rajon;
DROP TABLE IF EXISTS operuje;
DROP TABLE IF EXISTS loupez;
DROP TABLE IF EXISTS pouzije;
DROP TABLE IF EXISTS loupez_typ;
DROP TABLE IF EXISTS skoleni;
DROP TABLE IF EXISTS vlastnictvi;
DROP TABLE IF EXISTS vybaveni;
DROP TABLE IF EXISTS poukazka;
DROP TABLE IF EXISTS typ_vybaveni;
DROP TABLE IF EXISTS zbran;
DROP TABLE IF EXISTS past;
DROP TABLE IF EXISTS vybava;

CREATE TABLE zlodej
(
    ID_rodne_cislo VARCHAR(10) PRIMARY KEY,
    heslo VARCHAR(20) NOT NULL,
    vudce TINYINT(1) NOT NULL,
    jmeno VARCHAR(20),     
    prijmeni VARCHAR(20),
    prezdivka VARCHAR(20) NOT NULL UNIQUE,
    vek INTEGER NOT NULL,
    stav CHAR(1) NOT NULL,
    vypsana_odmena INTEGER NOT NULL
)ENGINE=InnoDB;

CREATE TABLE rajon
(
    ID_oblast VARCHAR(20) PRIMARY KEY,     
    pocet_lidi INTEGER NOT NULL,
    kapacita INTEGER NOT NULL,
    dostupne_bohatstvi  INTEGER NOT NULL
)ENGINE=InnoDB;

CREATE TABLE operuje
(
    ID_rodne_cislo VARCHAR(10) NOT NULL, 
    ID_oblast VARCHAR(20) NOT NULL
)ENGINE=InnoDB;

CREATE TABLE loupez
(
    ID_loupez INTEGER AUTO_INCREMENT PRIMARY KEY,
    korist INTEGER NOT NULL,
    ID_oblast VARCHAR(20) NOT NULL,
    ID_poukazka INTEGER NOT NULL,
    ID_loupez_typ CHAR(20) NOT NULL
)ENGINE=InnoDB;

CREATE TABLE pouzije
(
    ID_rodne_cislo VARCHAR(10) NOT NULL,
    ID_poukazka INTEGER NOT NULL
)ENGINE=InnoDB;

CREATE TABLE loupez_typ
(
    ID_loupez_typ CHAR(20) PRIMARY KEY,
    detaily VARCHAR(100),
    mira_obtiznosti VARCHAR(20) NOT NULL
)ENGINE=InnoDB;

CREATE TABLE skoleni
(
    ID_certifikat INTEGER AUTO_INCREMENT PRIMARY KEY,
    datum DATE NOT NULL,
    ID_loupez_typ CHAR(20),
    ID_rodne_cislo VARCHAR(10) NOT NULL,
    ID_vybaveni_typ CHAR(20)
)ENGINE=InnoDB;

CREATE TABLE vlastnictvi
(
    ID_vlastnictvi INTEGER AUTO_INCREMENT PRIMARY KEY,
    ID_rodne_cislo VARCHAR(10),
    ID_vyrobni_cislo INTEGER NOT NULL,
    od DATE NOT NULL,
    do DATE
)ENGINE=InnoDB;

CREATE TABLE vybaveni
(
    ID_vyrobni_cislo INTEGER PRIMARY KEY,
    ID_vybaveni_typ CHAR(20) NOT NULL,
    cena INTEGER NOT NULL
)ENGINE=InnoDB;

CREATE TABLE poukazka
(
    ID_poukazka INTEGER AUTO_INCREMENT PRIMARY KEY,
    datum DATE,
    ID_loupez_typ CHAR(20) NOT NULL
)ENGINE=InnoDB;

CREATE TABLE typ_vybaveni
(
    ID_vybaveni_typ CHAR(20) PRIMARY KEY,
    potrebna_uroven INTEGER NOT NULL
)ENGINE=InnoDB;

CREATE TABLE zbran
(
    ID_vybaveni_typ CHAR(20) PRIMARY KEY,
    poskozeni INTEGER NOT NULL,
    opotrebeni INTEGER NOT NULL
)ENGINE=InnoDB;

CREATE TABLE past
(
    ID_vybaveni_typ CHAR(20) PRIMARY KEY,
    ucinek VARCHAR(100),
    rozsah INTEGER NOT NULL
)ENGINE=InnoDB;

CREATE TABLE vybava
(
    ID_vybaveni_typ CHAR(20) PRIMARY KEY,
    efekt VARCHAR(100),
    umisteni VARCHAR(100)
)ENGINE=InnoDB;

ALTER TABLE operuje ADD FOREIGN KEY (ID_rodne_cislo) REFERENCES zlodej(ID_rodne_cislo) ON DELETE CASCADE;
ALTER TABLE operuje ADD FOREIGN KEY (ID_oblast) REFERENCES rajon(ID_oblast) ON DELETE CASCADE;
ALTER TABLE loupez ADD FOREIGN KEY (ID_oblast) REFERENCES rajon(ID_oblast) ON DELETE CASCADE;
ALTER TABLE loupez ADD FOREIGN KEY (ID_poukazka) REFERENCES poukazka(ID_poukazka) ON DELETE CASCADE;
ALTER TABLE loupez ADD FOREIGN KEY (ID_loupez_typ) REFERENCES loupez_typ(ID_loupez_typ) ON DELETE CASCADE;
ALTER TABLE pouzije ADD FOREIGN KEY (ID_poukazka) REFERENCES poukazka(ID_poukazka) ON DELETE CASCADE;
ALTER TABLE pouzije ADD FOREIGN KEY (ID_rodne_cislo) REFERENCES zlodej(ID_rodne_cislo) ON DELETE CASCADE;
ALTER TABLE skoleni ADD FOREIGN KEY (ID_loupez_typ) REFERENCES loupez_typ(ID_loupez_typ) ON DELETE CASCADE;
ALTER TABLE skoleni ADD FOREIGN KEY (ID_rodne_cislo) REFERENCES zlodej(ID_rodne_cislo) ON DELETE CASCADE;
ALTER TABLE skoleni ADD FOREIGN KEY (ID_vybaveni_typ) REFERENCES typ_vybaveni(ID_vybaveni_typ) ON DELETE CASCADE;
ALTER TABLE vlastnictvi ADD FOREIGN KEY (ID_rodne_cislo) REFERENCES zlodej(ID_rodne_cislo) ON DELETE CASCADE;
ALTER TABLE vlastnictvi ADD FOREIGN KEY (ID_vyrobni_cislo) REFERENCES vybaveni(ID_vyrobni_cislo) ON DELETE CASCADE;
ALTER TABLE vybaveni ADD FOREIGN KEY (ID_vybaveni_typ) REFERENCES typ_vybaveni(ID_vybaveni_typ) ON DELETE CASCADE;
ALTER TABLE poukazka ADD FOREIGN KEY (ID_loupez_typ) REFERENCES loupez_typ(ID_loupez_typ) ON DELETE CASCADE;
ALTER TABLE zbran ADD CONSTRAINT FK_typ_zbran FOREIGN KEY (ID_vybaveni_typ) REFERENCES typ_vybaveni(ID_vybaveni_typ) ON DELETE CASCADE;
ALTER TABLE past ADD CONSTRAINT FK_typ_past FOREIGN KEY (ID_vybaveni_typ) REFERENCES typ_vybaveni(ID_vybaveni_typ) ON DELETE CASCADE;
ALTER TABLE vybava ADD CONSTRAINT FK_typ_vybava FOREIGN KEY (ID_vybaveni_typ) REFERENCES typ_vybaveni(ID_vybaveni_typ) ON DELETE CASCADE;

INSERT INTO zlodej (ID_rodne_cislo, heslo, vudce, jmeno, prijmeni, prezdivka, vek, stav, vypsana_odmena) VALUES('9657055661','123',1,'Jan','Trneny','Morvud','20','Z','500');
INSERT INTO zlodej (ID_rodne_cislo, heslo, vudce, jmeno, prijmeni, prezdivka, vek, stav, vypsana_odmena) VALUES('8605104959','123',1,'Jakub','Trubka','Nothrax','22','Z','0');
INSERT INTO zlodej (ID_rodne_cislo, heslo, vudce, jmeno, prijmeni, prezdivka, vek, stav, vypsana_odmena) VALUES('9952020364','123',0,'Bohdan','','Morous','30','Z','1000');
INSERT INTO zlodej (ID_rodne_cislo, heslo, vudce, jmeno, prijmeni, prezdivka, vek, stav, vypsana_odmena) VALUES('9554030068','123',0,'','Paras','Hori','21','Z','0');
INSERT INTO zlodej (ID_rodne_cislo, heslo, vudce, jmeno, prijmeni, prezdivka, vek, stav, vypsana_odmena) VALUES('9705162775','123',0,'','','Brodan','26','Z','952');
INSERT INTO zlodej (ID_rodne_cislo, heslo, vudce, jmeno, prijmeni, prezdivka, vek, stav, vypsana_odmena) VALUES('9502131540','123',0,'Frederik','Notik','Maxim','26','Z','952');
INSERT INTO zlodej (ID_rodne_cislo, heslo, vudce, jmeno, prijmeni, prezdivka, vek, stav, vypsana_odmena) VALUES('9705219436','123',0,'Gejda','Paro','Gejda','27','Z','9520');
INSERT INTO zlodej (ID_rodne_cislo, heslo, vudce, jmeno, prijmeni, prezdivka, vek, stav, vypsana_odmena) VALUES('9305116491','123',0,'Miro','Mojda','Mokas','28','Z','7552');
INSERT INTO rajon (ID_oblast, pocet_lidi, kapacita, dostupne_bohatstvi) VALUES('Cejl','1','10','1000000');
INSERT INTO rajon (ID_oblast, pocet_lidi, kapacita, dostupne_bohatstvi) VALUES('Lidicka','1','30','20000000');
INSERT INTO rajon (ID_oblast, pocet_lidi, kapacita, dostupne_bohatstvi) VALUES('Ceska','3','50','200000000');
INSERT INTO rajon (ID_oblast, pocet_lidi, kapacita, dostupne_bohatstvi) VALUES('Moravak','0','10','150000');
INSERT INTO rajon (ID_oblast, pocet_lidi, kapacita, dostupne_bohatstvi) VALUES('Semilaso','0','5','100000');
INSERT INTO loupez_typ (ID_loupez_typ, detaily, mira_obtiznosti) VALUES('Bank robbery', 'Need multiple people', 'Very hard');
INSERT INTO loupez_typ (ID_loupez_typ, detaily, mira_obtiznosti) VALUES('Pickpocket', 'Need finesse', 'Simple');
INSERT INTO loupez_typ (ID_loupez_typ, detaily, mira_obtiznosti) VALUES('Assault', 'Need strenght', 'Moderate');
INSERT INTO loupez_typ (ID_loupez_typ, detaily, mira_obtiznosti) VALUES('Burglary', 'Need finesse', 'Easy');
INSERT INTO poukazka (datum, ID_loupez_typ) VALUES('2000-1-1','Bank robbery');
INSERT INTO poukazka (datum, ID_loupez_typ) VALUES('2000-1-1','Assault');
INSERT INTO poukazka (datum, ID_loupez_typ) VALUES('2000-1-1','Pickpocket');
INSERT INTO poukazka (datum, ID_loupez_typ) VALUES('2000-1-1','Pickpocket');
INSERT INTO poukazka (datum, ID_loupez_typ) VALUES('2000-1-1','Pickpocket');
INSERT INTO loupez (korist, ID_oblast, ID_poukazka, ID_loupez_typ) VALUES('50','Cejl','3', 'Pickpocket');
INSERT INTO loupez (korist, ID_oblast, ID_poukazka, ID_loupez_typ) VALUES('100','Lidicka','2','Assault');
INSERT INTO loupez (korist, ID_oblast, ID_poukazka, ID_loupez_typ) VALUES('100000','Ceska','1','Bank robbery');
INSERT INTO typ_vybaveni (ID_vybaveni_typ, potrebna_uroven) VALUES('Sword','1');
INSERT INTO typ_vybaveni (ID_vybaveni_typ, potrebna_uroven) VALUES('Trap','2');
INSERT INTO typ_vybaveni (ID_vybaveni_typ, potrebna_uroven) VALUES('Armor','1');
INSERT INTO typ_vybaveni (ID_vybaveni_typ, potrebna_uroven) VALUES('Peak','10');
INSERT INTO typ_vybaveni (ID_vybaveni_typ, potrebna_uroven) VALUES('Knife','1');
INSERT INTO skoleni (datum, ID_loupez_typ, ID_rodne_cislo) VALUES('2018-01-04', 'Pickpocket','9657055661');
INSERT INTO skoleni (datum, ID_loupez_typ, ID_rodne_cislo) VALUES('2018-01-05', 'Assault','9657055661');
INSERT INTO skoleni (datum, ID_loupez_typ, ID_rodne_cislo) VALUES('2018-01-06', 'Bank robbery','9952020364');
INSERT INTO skoleni (datum, ID_loupez_typ, ID_rodne_cislo) VALUES('2018-01-07', 'Bank robbery','9554030068');
INSERT INTO skoleni (datum, ID_loupez_typ, ID_rodne_cislo) VALUES('2018-01-08', 'Bank robbery','9705162775');
INSERT INTO skoleni (datum, ID_rodne_cislo, ID_vybaveni_typ) VALUES('2018-01-09','8605104959','Sword');
INSERT INTO vybaveni (ID_vyrobni_cislo, ID_vybaveni_typ, cena) VALUES('15487','Sword', '100');
INSERT INTO vybaveni (ID_vyrobni_cislo, ID_vybaveni_typ, cena) VALUES('48744','Sword', '100');
INSERT INTO vybaveni (ID_vyrobni_cislo, ID_vybaveni_typ, cena) VALUES('48745','Trap', '100');
INSERT INTO vybaveni (ID_vyrobni_cislo, ID_vybaveni_typ, cena) VALUES('48747','Knife', '100');
INSERT INTO vybaveni (ID_vyrobni_cislo, ID_vybaveni_typ, cena) VALUES('48749','Armor', '100');

INSERT INTO vybaveni (ID_vyrobni_cislo, ID_vybaveni_typ, cena) VALUES('58749','Armor', '100');
INSERT INTO vybaveni (ID_vyrobni_cislo, ID_vybaveni_typ, cena) VALUES('58748','Peak', '10');
INSERT INTO vybaveni (ID_vyrobni_cislo, ID_vybaveni_typ, cena) VALUES('58747','Knife', '20');
INSERT INTO vybaveni (ID_vyrobni_cislo, ID_vybaveni_typ, cena) VALUES('58746','Trap', '30');
INSERT INTO vybaveni (ID_vyrobni_cislo, ID_vybaveni_typ, cena) VALUES('58745','Armor', '45');
INSERT INTO vybaveni (ID_vyrobni_cislo, ID_vybaveni_typ, cena) VALUES('58744','Peak', '50');
INSERT INTO vybaveni (ID_vyrobni_cislo, ID_vybaveni_typ, cena) VALUES('58743','Knife', '600');
INSERT INTO vybaveni (ID_vyrobni_cislo, ID_vybaveni_typ, cena) VALUES('58742','Trap', '60');
INSERT INTO vybaveni (ID_vyrobni_cislo, ID_vybaveni_typ, cena) VALUES('58741','Armor', '500');
INSERT INTO vybaveni (ID_vyrobni_cislo, ID_vybaveni_typ, cena) VALUES('58740','Trap', '151');

INSERT INTO operuje (ID_rodne_cislo,ID_oblast ) VALUES('9657055661','Cejl');
INSERT INTO operuje (ID_rodne_cislo,ID_oblast ) VALUES('9657055661','Lidicka');
INSERT INTO operuje (ID_rodne_cislo,ID_oblast ) VALUES('9952020364','Ceska');
INSERT INTO operuje (ID_rodne_cislo,ID_oblast ) VALUES('9554030068','Ceska');
INSERT INTO operuje (ID_rodne_cislo,ID_oblast ) VALUES('9705162775','Ceska');
INSERT INTO pouzije (ID_rodne_cislo, ID_poukazka ) VALUES('9657055661','3');
INSERT INTO pouzije (ID_rodne_cislo, ID_poukazka ) VALUES('9657055661','2');
INSERT INTO pouzije (ID_rodne_cislo, ID_poukazka ) VALUES('9952020364','1');
INSERT INTO pouzije (ID_rodne_cislo, ID_poukazka ) VALUES('9554030068','1');
INSERT INTO pouzije (ID_rodne_cislo, ID_poukazka ) VALUES('9705162775','1');
INSERT INTO vlastnictvi (ID_rodne_cislo, ID_vyrobni_cislo, od, do ) VALUES('8605104959','15487','2000-3-3','2000-4-4');
INSERT INTO vlastnictvi (ID_rodne_cislo, ID_vyrobni_cislo, od) VALUES('8605104959','48744','2000-3-3');
INSERT INTO zbran(ID_vybaveni_typ, poskozeni, opotrebeni) VALUES('Sword','100','10');
INSERT INTO zbran(ID_vybaveni_typ, poskozeni, opotrebeni) VALUES('Peak','50','10');
INSERT INTO zbran(ID_vybaveni_typ, poskozeni, opotrebeni) VALUES('Knife','10','10');
INSERT INTO past (ID_vybaveni_typ, ucinek, rozsah) VALUES('Trap','Freezing','5');
INSERT INTO vybava (ID_vybaveni_typ, efekt, umisteni) VALUES('Armor','Higher success rate','Hand');



