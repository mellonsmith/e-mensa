DROP DATABASE IF EXISTS emensawerbeseite;
CREATE DATABASE if not exists emensawerbeseite;

USE emensawerbeseite;

CREATE TABLE if not exists gericht (id int8 primary key UNIQUE , name varchar(80) not null unique , beschreibung varchar(800) not null , erfasst_am date not null, vegetarisch boolean not null default 0, vegan boolean not null default 0 , preis_intern double not null CHECK ( preis_intern > 0 ), preis_extern double not null CHECK (preis_intern < preis_extern));

CREATE TABLE if not exists allergen (code char(4) PRIMARY KEY UNIQUE, name varchar(300) not null , typ varchar(20) not null default 'allergen');

CREATE TABLE if not exists kategorie (id int8 PRIMARY KEY UNIQUE , name varchar(80) not null , eltern_id int8 REFERENCES kategorie(id), bildname varchar(200));

CREATE TABLE if not exists gericht_hat_allergen (code char(4) REFERENCES allergen(code), gericht_id int8 not null REFERENCES gericht(id));

CREATE TABLE IF NOT EXISTS gericht_hat_kategorie (gericht_id int8 not null REFERENCES gericht(id), kategorie_id int8 not null REFERENCES kategorie(id));

CREATE TABLE IF NOT EXISTS newsletteranmeldungen (vorname varchar(300) not null, email varchar(300) unique not null, language varchar(300) );

CREATE TABLE IF NOT EXISTS besucher (ip varchar(300) not null);

UPDATE
    allergen
SET
    name = 'Test-commit'
Where
    code = 'a6';

INSERT INTO gericht VALUE (21, 'Pommes mit Currywurst', 'Stinken nach Jonathan', '12.12.12', 0, 0, 10, 11 );

SELECT * FROM gericht g LEFT JOIN gericht_hat_allergen gha ON g.id = gha.gericht_id RIGHT JOIN allergen a on gha.code = a.code;

SELECT COUNT(name) AS anzahl, name FROM kategorie k RIGHT JOIN gericht_hat_kategorie ghk on k.id = ghk.kategorie_id GROUP BY name HAVING anzahl > 2 ORDER BY COUNT(name) ASC;

SELECT COUNT(code) FROM allergen

