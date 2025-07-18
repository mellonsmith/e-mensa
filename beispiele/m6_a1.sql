USE emensawerbeseite;

DROP TABLE if exists bewertung;
CREATE TABLE if not exists bewertung
(
    id           int8 primary key UNIQUE AUTO_INCREMENT,
    bemerkung    varchar(280) not null CHECK(LENGTH(bemerkung) >= 5),
    bewertungszeitpunkt date not null,
    sterne_bewertung varchar(280) not null,
    hervorgehoben boolean not null default 0,
    gericht_id int8 not null,
    benutzer_id int8 not null,
    FOREIGN KEY (benutzer_id) REFERENCES benutzer(id)
);

