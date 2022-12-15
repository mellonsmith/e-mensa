CREATE VIEW IF NOT EXISTS view_suppengerichte AS
SELECT g.name AS suppengericht FROM gericht g WHERE g.name LIKE '%suppe%';

CREATE VIEW IF NOT EXISTS view_anmeldungen AS
SELECT b.anzahlanmeldung AS anmeldungen, b.name AS name FROM benutzer b ORDER BY b.anzahlanmeldung DESC;

Create VIEW IF NOT EXISTS view_kategoriegerichte_vegetarisch AS
SELECT g.name, k.name AS vegetarischesGericht FROM gericht g LEFT JOIN gericht_hat_kategorie ghk on g.id = ghk.gericht_id
                                                             LEFT JOIN kategorie k on ghk.kategorie_id = k.id WHERE g.vegetarisch = 1;