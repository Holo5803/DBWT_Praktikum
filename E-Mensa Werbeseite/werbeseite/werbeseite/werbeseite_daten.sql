
USE emensawerbeseite;

INSERT INTO `allergen` (`code`, `name`, `typ`) VALUES
	('a', 'Getreideprodukte', 'Getreide (Gluten)'),
	('a1', 'Weizen', 'Allergen'),
	('a2', 'Roggen', 'Allergen'),
	('a3', 'Gerste', 'Allergen'),
	('a4', 'Dinkel', 'Allergen'),
	('a5', 'Hafer', 'Allergen'),
	('a6', 'Dinkel', 'Allergen'),
	('b', 'Fisch', 'Allergen'),
	('c', 'Krebstiere', 'Allergen'),
	('d', 'Schwefeldioxid/Sulfit', 'Allergen'),
	('e', 'Sellerie', 'Allergen'),
	('f', 'Milch und Laktose', 'Allergen'),
	('f1', 'Butter', 'Allergen'),
	('f2', 'Käse', 'Allergen'),
	('f3', 'Margarine', 'Allergen'),
	('g', 'Sesam', 'Allergen'),
	('h', 'Nüsse', 'Allergen'),
	('h1', 'Mandeln', 'Allergen'),
	('h2', 'Haselnüsse', 'Allergen'),
	('h3', 'Walnüsse', 'Allergen'),
	('i', 'Erdnüsse', 'Allergen');

INSERT INTO `gericht` (`id`, `name`, `beschreibung`, `erfasst_am`, `vegan`, `vegetarisch`, `preisintern`, `preisextern`) VALUES
	(1, 'Bratkartoffeln mit Speck und Zwiebeln', 'Kartoffeln mit Zwiebeln und gut Speck', '2020-08-25', 0, 0, 2.3, 4),
	(3, 'Bratkartoffeln mit Zwiebeln', 'Kartoffeln mit Zwiebeln und ohne Speck', '2020-08-25', 1, 1, 2.3, 4),
	(4, 'Grilltofu', 'Fein gewürzt und mariniert', '2020-08-25', 1, 1, 2.5, 4.5),
	(5, 'Lasagne', 'Klassisch mit Bolognesesoße und Creme Fraiche', '2020-08-24', 0, 0, 2.5, 4.5),
	(6, 'Lasagne vegetarisch', 'Klassisch mit Sojagranulatsoße und Creme Fraiche', '2020-08-24', 0, 1, 2.5, 4.5),
	(7, 'Hackbraten', 'Nicht nur für Hacker', '2020-08-25', 0, 0, 2.5, 4),
	(8, 'Gemüsepfanne', 'Gesundes aus der Region, deftig angebraten', '2020-08-25', 1, 1, 2.3, 4),
	(9, 'Hühnersuppe', 'Suppenhuhn trifft Petersilie', '2020-08-25', 0, 0, 2, 3.5),
	(10, 'Forellenfilet', 'mit Kartoffeln und Dilldip', '2020-08-22', 0, 0, 3.8, 5),
	(11, 'Kartoffel-Lauch-Suppe', 'der klassische Bauchwärmer mit frischen Kräutern', '2020-08-22', 0, 1, 2, 3),
	(12, 'Kassler mit Rosmarinkartoffeln', 'dazu Salat und Senf', '2020-08-23', 0, 0, 3.8, 5.2),
	(13, 'Drei Reibekuchen mit Apfelmus', 'grob geriebene Kartoffeln aus der Region', '2020-08-23', 0, 1, 2.5, 4.5),
	(14, 'Pilzpfanne', 'die legendäre Pfanne aus Pilzen der Saison', '2020-08-23', 0, 1, 3, 5),
	(15, 'Pilzpfanne vegan', 'die legendäre Pfanne aus Pilzen der Saison ohne Käse', '2020-08-24', 1, 1, 3, 5),
	(16, 'Käsebrötchen', 'schmeckt vor und nach dem Essen', '2020-08-24', 0, 1, 1, 1.5),
	(17, 'Schinkenbrötchen', 'schmeckt auch ohne Hunger', '2020-08-25', 0, 0, 1.25, 1.75),
	(18, 'Tomatenbrötchen', 'mit Schnittlauch und Zwiebeln', '2020-08-25', 1, 1, 1, 1.5),
	(19, 'Mousse au Chocolat', 'sahnige schweizer Schokolade rundet jedes Essen ab', '2020-08-26', 0, 1, 1.25, 1.75),
	(20, 'Suppenkreation á la Chef', 'was verschafft werden muss, gut und günstig', '2020-08-26', 0, 0, 0.5, 0.9);

INSERT INTO `gericht_hat_allergen` (`code`, `gericht_id`) VALUES
	('h', 1),	
	('a3', 1),	
	('a4', 1),	
	('f1', 3),	
	('a6', 3),	
	('i', 3),	
	('a3', 4),	
	('f1', 4),	
	('a4', 4),	
	('h3', 4),	
	('d', 6),	
	('h1',7),	
	('a2', 7),	
	('h3', 7),	
	('c', 7),	
	('a3', 8),	
	('h3', 10),	
	('d', 10),	
	('f', 10),	
	('f2', 12),	
	('h1', 12),	
	('a5',12),	
	('c', 1),	
	('a2', 9),	
	('i', 14),	
	('f1', 1),	
	('a1', 15),	
	('a4', 15),	
	('i', 15),	
	('f3', 15),	
	('h3', 15);

INSERT INTO `kategorie` (`id`, `eltern_id`, `name`, `bildname`) VALUES
	(1, NULL, 'Aktionen', 'kat_aktionen.png'),
	(2, NULL, 'Menus', 'kat_menu.gif'),
	(3, 2, 'Hauptspeisen', 'kat_menu_haupt.bmp'),
	(4, 2, 'Vorspeisen', 'kat_menu_vor.svg'),
	(5, 2, 'Desserts', 'kat_menu_dessert.pic'),
	(6, 1, 'Mensastars', 'kat_stars.tif'),
	(7, 1, 'Erstiewoche', 'kat_erties.jpg');

INSERT INTO `gericht_hat_kategorie` (`kategorie_id`, `gericht_id`) VALUES
	(3, 1),	(3, 3),	(3, 4),	(3, 5),	(3, 6),	(3, 7),	(3, 9),	(4, 16), (4, 17), (4, 18), (5, 16), (5, 17), (5, 18);
-- 2.4
SELECT COUNT(*) AS Anzahl_Gerichte  FROM gericht;
SELECT COUNT(*) AS Anzahl_Allergen FROM allergen;
SELECT COUNT(*) AS Anzahl_Kategorie FROM kategorie;
SELECT COUNT(*) AS Anzahl_Gericht_hat_Allergen FROM gericht_hat_allergen;
SELECT COUNT(*) AS Anzahl_Gericht_hat_Kategorie FROM gericht_hat_kategorie;


-- Aufgabe 3

-- 3.1 Alle Daten aller Gerichte
SELECT * FROM gericht;

-- 3.2 Das Erfassungsdatum sowie den Namen aller Gerichte
SELECT gericht.erfasst_am, gericht.name FROM gericht;

-- 3.3 Das Erfassungsdatum sowie den Namen (als Attributname im Ergebnis) aller Gerichte absteigend sortiert nach Gerichtname
SELECT gericht.erfasst_am, gericht.name AS Gerichtname FROM gericht ORDER BY name DESC;

-- 3.4 Den Namen sowie die Beschreibung der Gerichte aufsteigend sortiert nach Namen, wobei nur 5 Datensätze dargestellt werden sollen.
SELECT name, gericht.beschreibung FROM gericht ORDER BY name ASC LIMIT 5;

-- 3.5 Ändern Sie die vorherige Abfrage so ab, sodass 10 Datensätze dargestellt werden, die nach den ersten 5 Datensätzen folgen. (Die ersten 5 Datensätze werden übersprungen)
SELECT name, gericht.beschreibung FROM gericht ORDER BY name ASC LIMIT 10 OFFSET 5;

-- 3.6 Zeigen Sie alle möglichen Allergen-Typen (typ), wobei Sie keine doppelten Einträge darstellen.
SELECT DISTINCT allergen.typ FROM allergen;

-- 3.7 Namen von Gerichten, deren Name mit einem klein- oder großgeschriebenen „L“ beginnt
SELECT gericht.name FROM gericht WHERE name LIKE 'L%' OR name LIKE 'l%';

-- 3.8 Ids und Namen von Gerichten, deren Namen ein „suppe“ an beliebiger Stelle enthält absteigend sortiert nach Namen.
SELECT  gericht.id, gericht.name FROM gericht WHERE name LIKE '%suppe%' ORDER BY name DESC;

-- 3.9 Alle Kategorie, die keine Elterneinträge besitzen
SELECT kategorie.id, kategorie.name FROM kategorie WHERE eltern_id IS NULL;

-- 3.10 Korrigieren Sie den Wert „Dinkel“ in der Tabelle allergen mit dem code a6 zu „Kamut“
UPDATE allergen SET name = 'Kamut' WHERE code = 'a6';

-- 3.11 Fügen Sie das Gericht „Currywurst mit Pommes“ hinzu und tragen Sie es in der Kategorie „Hauptspeise“ ein.
INSERT INTO `gericht` (`id`, `name`, `beschreibung`, `erfasst_am`, `vegan`, `vegetarisch`, `preisintern`, `preisextern`)
VALUES (2, 'Currywurst mit Pommes', 'Leckere Currywurst mit knusperige Pommes Frites', curdate(), FALSE, FALSE, 4.0, 5.5);

INSERT INTO `gericht_hat_kategorie` (`kategorie_id`, `gericht_id`)
VALUES ((SELECT kategorie.id FROM kategorie WHERE name = 'Hauptspeisen'), 2);

-- Aufgabe 6

-- 6.1 Alle Gerichte mit allen zugehörigen Allergenen
SELECT gericht.name AS Gericht, allergen.name AS Allergen
FROM gericht JOIN gericht_hat_allergen ON gericht.id = gericht_hat_allergen.gericht_id
JOIN allergen ON gericht_hat_allergen.code = allergen.code;

-- 6.2 Ändern Sie die vorherige Abfrage so ab, dass alle existierenden Gerichte dargestellt werden (auch wenn keine Allergene enthalten sind).
SELECT gericht.name AS Gericht, allergen.name AS Allergen
FROM gericht
LEFT JOIN gericht_hat_allergen ON gericht.id = gericht_hat_allergen.gericht_id
LEFT JOIN allergen ON gericht_hat_allergen.code = allergen.code;

-- 6.3 Ändern Sie die vorherige Abfrage so ab, sodass im Ergebnis alle existierenden Allergene dargestellt werden (auch wenn diese nicht einem Gericht zugeordnet sind).
SELECT gericht.id AS GerichtID, gericht.name AS GerichtName, allergen.code AS AllergenCode, allergen.name AS AllergenName
FROM gericht
RIGHT JOIN gericht_hat_allergen ON gericht.id = gericht_hat_allergen.gericht_id
RIGHT JOIN allergen on gericht_hat_allergen.code = allergen.code;

-- 6.4 Die Anzahl der Gerichte pro Kategorie aufsteigend sortiert nach Anzahl.
SELECT kategorie.id AS KategorieID, kategorie.name AS KategorieName, COUNT(gericht_hat_kategorie.gericht_id) AS AnzahlvonGericht
FROM kategorie
LEFT JOIN gericht_hat_kategorie ON kategorie.id = gericht_hat_kategorie.kategorie_id
GROUP BY kategorie.id, kategorie.name
ORDER BY AnzahlvonGericht ASC;


-- 6.5 Ändern Sie die vorherige Abfrage so ab, dass dabei nur die Kategorien dargestellt werden, die mehr als 2 Gerichte besitzen.
SELECT kategorie.id AS KategorieID, kategorie.name AS KategorieName, COUNT(gericht_hat_kategorie.gericht_id) AS AnzahlvonGericht
FROM kategorie
LEFT JOIN gericht_hat_kategorie ON kategorie.id = gericht_hat_kategorie.kategorie_id
GROUP BY kategorie.id, kategorie.name
HAVING AnzahlvonGericht > 2
ORDER BY AnzahlvonGericht ASC;


-- Aufgabe 7: Nebenbedingungen und referentielle Integrität


-- Unique Constraints hinzufügen


    -- Gericht Tabelle
        ALTER TABLE gericht
        ADD CONSTRAINT UniqueGericht UNIQUE (name);

        ALTER TABLE gericht
        ADD CONSTRAINT UniqueGerichtID UNIQUE (id);

    -- Allergen Tabelle
        ALTER TABLE allergen
        ADD CONSTRAINT UniqueAllergenCode UNIQUE (code);

        ALTER TABLE allergen
        ADD CONSTRAINT UniqueAllergenName UNIQUE (name);

    -- Kategorie Tabelle
        ALTER TABLE kategorie
        ADD CONSTRAINT UniqueKategorie UNIQUE (name);

        ALTER TABLE kategorie
        ADD CONSTRAINT UniqueKategorieID UNIQUE (id);


-- Fremdschlüsselbeziehungen hinzufügen


    -- gericht_hat_allergen Tabelle
        ALTER TABLE gericht_hat_allergen
        ADD CONSTRAINT fk_gericht FOREIGN KEY (gericht_id) REFERENCES gericht(id)
            ON DELETE CASCADE
            ON UPDATE CASCADE,
        ADD CONSTRAINT fk_allergen FOREIGN KEY (code) REFERENCES allergen(code)
            ON DELETE CASCADE
            ON UPDATE CASCADE;

    -- gericht_hat_kategorie Tabelle
        ALTER TABLE gericht_hat_kategorie
        ADD CONSTRAINT fk_gericht_kat FOREIGN KEY (gericht_id) REFERENCES gericht(id)
            ON DELETE CASCADE
            ON UPDATE CASCADE,
        ADD CONSTRAINT fk_kat FOREIGN KEY (kategorie_id) REFERENCES kategorie(id)
            ON DELETE CASCADE
            ON UPDATE CASCADE;

    -- Referenzieren der Eltern-ID
        ALTER TABLE kategorie
        ADD CONSTRAINT fk_kat_eltern FOREIGN KEY (eltern_id) REFERENCES kategorie(id)
            ON DELETE SET NULL
            ON UPDATE CASCADE;

