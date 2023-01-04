USE emensawerbeseite;

CREATE TABLE if not exists bewertung
(
    id           int8 primary key UNIQUE,
    bemerkung    varchar(280) not null CHECK(LENGTH(bemerkung) >= 5),
    bewertungszeitpunkt date not null,
    sterne_bewertung varchar(280) not null,
    hervorgehoben boolean not null default 0,
    benutzer_id int8 not null,
    FOREIGN KEY (benutzer_id) REFERENCES benutzer(id)
);