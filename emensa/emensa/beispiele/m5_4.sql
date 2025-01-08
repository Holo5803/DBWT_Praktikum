USE emensawerbeseite;

-- M5_4.1

CREATE VIEW view_suppengerichte AS
SELECT *
FROM gericht
WHERE name like '%suppe%';

-- M5_4.2
CREATE VIEW view_anmeldungen AS
SELECT benutzer.id AS benutzer_id, benutzer.name, benutzer.email, benutzer.anzahlanmeldungen
FROM benutzer
ORDER BY benutzer.anzahlanmeldungen DESC;

-- M5_4.3
CREATE VIEW view_kategoriegerichte_vegetarisch AS
SELECT kategorie.id   AS kategorie_id,
       kategorie.name AS kategorie_name,
       gericht.id     AS gericht_id,
       gericht.name   AS gericht_name,
       gericht.vegetarisch
FROM kategorie
         LEFT JOIN gericht_hat_kategorie ON kategorie.id = gericht_hat_kategorie.kategorie_id
         LEFT JOIN gericht on gericht.id = gericht_hat_kategorie.gericht_id
WHERE gericht.vegetarisch = 1
   OR gericht.id IS NUll;


