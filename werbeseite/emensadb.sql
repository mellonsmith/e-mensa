    DROP DATABASE IF EXISTS emensawerbeseite;
CREATE DATABASE if not exists emensawerbeseite;

USE emensawerbeseite;

CREATE TABLE if not exists gericht
(
    id           int8 primary key UNIQUE,
    name         varchar(80)  not null unique,
    beschreibung varchar(800) not null,
    erfasst_am   date         not null,
    vegetarisch  boolean      not null default 0,
    vegan        boolean      not null default 0,
    preis_intern double       not null CHECK ( preis_intern > 0 ),
    preis_extern double       not null CHECK (preis_intern < preis_extern)
);

CREATE TABLE if not exists allergen
(
    code char(4) PRIMARY KEY UNIQUE,
    name varchar(300) not null,
    typ  varchar(20)  not null default 'allergen'
);

CREATE TABLE if not exists kategorie
(
    id        int8 PRIMARY KEY UNIQUE,
    name      varchar(80) not null,
    eltern_id int8 REFERENCES kategorie (id),
    bildname  varchar(200)
);

CREATE TABLE if not exists gericht_hat_allergen
(
    code       char(4) REFERENCES allergen (code),
    gericht_id int8 not null REFERENCES gericht (id)
);

CREATE TABLE IF NOT EXISTS gericht_hat_kategorie
(
    gericht_id   int8 not null REFERENCES gericht (id),
    kategorie_id int8 not null REFERENCES kategorie (id)
);

CREATE TABLE IF NOT EXISTS newsletteranmeldungen
(
    vorname  varchar(300)        not null,
    email    varchar(300) unique not null,
    language varchar(300)
);

CREATE TABLE IF NOT EXISTS besucher
(
    ip varchar(300) not null
);

UPDATE
    allergen
SET name = 'Test-commit'
Where code = 'a6';

INSERT INTO gericht VALUE (21, 'Pommes mit Currywurst', 'Stinken nach Jonathan', '12.12.12', 0, 0, 10, 11);

SELECT *
FROM gericht g
         LEFT JOIN gericht_hat_allergen gha ON g.id = gha.gericht_id
         RIGHT JOIN allergen a on gha.code = a.code;

SELECT COUNT(name) AS anzahl, name
FROM kategorie k
         RIGHT JOIN gericht_hat_kategorie ghk on k.id = ghk.kategorie_id
GROUP BY name
HAVING anzahl > 2
ORDER BY COUNT(name) ASC;

SELECT COUNT(code)
FROM allergen;

CREATE TABLE IF NOT EXISTS ersteller
(
    id    int AUTO_INCREMENT,
    email varchar(300) unique not null,
    name  varchar(300) default 'anonym',
    primary key (id)
);

CREATE TABLE IF NOT EXISTS wunschgericht
(
    id               int8 primary key UNIQUE AUTO_INCREMENT,
    name             varchar(300),
    beschreibung     varchar(300),
    erstellungsdatum date not null,
    e_id             int,
   FOREIGN KEY (e_id) references ersteller(id)
);

SELECT * FROM wunschgericht ORDER BY erstellungsdatum DESC LIMIT 5;

ALTER TABLE gericht_hat_kategorie
    ADD CONSTRAINT UC_Gericht_Kategorie UNIQUE (gericht_id, kategorie_id);

CREATE INDEX name_index
    ON gericht (name);

ALTER TABLE gericht_hat_allergen DROP FOREIGN KEY gericht_hat_allergen_ibfk_2;
ALTER TABLE gericht_hat_allergen add constraint gericht_hat_allergen_ibfk_2 FOREIGN KEY(gericht_id) references gericht(id) ON DELETE CASCADE;

ALTER TABLE gericht_hat_kategorie DROP FOREIGN KEY gericht_hat_kategorie_ibfk_1;
ALTER TABLE gericht_hat_kategorie add constraint gericht_hat_kategorie_ibfk_1 FOREIGN KEY(gericht_id) references gericht(id) ON DELETE CASCADE;

ALTER TABLE kategorie ADD FOREIGN KEY (eltern_id) REFERENCES kategorie(id);

ALTER TABLE gericht_hat_allergen DROP FOREIGN KEY gericht_hat_allergen_ibfk_1,
ADD CONSTRAINT FOREIGN KEY index_allergen_code (code) REFERENCES allergen(code) ON UPDATE CASCADE;



CREATE TABLE IF NOT EXISTS benutzer
    (
    id                  int8 primary key UNIQUE AUTO_INCREMENT,
    name                varchar(200) not null,
    email               varchar(100) not null UNIQUE,
    passwort            varchar(200) not null,
    admin               boolean not null default(false),
    anzahlfehler        int not null default(0),
    anzahlanmeldung     int not null,
    letzteanmeldung     datetime,
    letzterfehler       datetime
    );

ALTER TABLE gericht ADD bildname varchar(200) default(NULL);

CREATE PROCEDURE neueAnmeldung (
    IN inputID INT8
) BEGIN
   UPDATE benutzer SET anzahlanmeldung = anzahlanmeldung + 1 WHERE id = inputID;
END;

