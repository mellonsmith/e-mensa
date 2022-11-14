DROP DATABASE IF EXISTS emensawerbeseite;
CREATE DATABASE if not exists emensawerbeseite;

USE emensawerbeseite;

CREATE TABLE if not exists gericht (id int8 primary key , name varchar(80) not null unique , beschreibung varchar(800) not null , erfasst_am date not null, vegetarisch boolean not null default 0, vegan boolean not null default 0 , preis_intern double not null CHECK ( preis_intern > 0 ), preis_extern double not null CHECK (preis_intern < preis_extern));

CREATE TABLE if not exists allergen (code char(4) PRIMARY KEY , name varchar(300) not null , typ varchar(20) not null default 'allergen');

CREATE TABLE if not exists kategorie (id int8 PRIMARY KEY , name varchar(80) not null , eltern_id int8, bildname varchar(200));

CREATE TABLE if not exists gericht_hat_allergen (code char(4), gericht_id int8 not null);

CREATE TABLE IF NOT EXISTS gericht_hat_kategorie (gericht_id int8 not null, kategorie_id int8 not null);



UPDATE
    allergen
SET
    name = 'Kamut'
Where
    code = 'a6';

INSERT INTO gericht VALUE (21, 'Pommes mit Currywurst', 'Stinken nach Jonathan', '12.12.12', 0, 0, 10, 11 );