USE emensawerbeseite;

CREATE TABLE IF NOT EXISTS `bewertung`
(
    `id`                  INT AUTO_INCREMENT PRIMARY KEY,
    `benutzer_id`         INT8                                                  NOT NULL,
    `gericht_id`          INT8                                                  NOT NULL,
    `bemerkung`           TEXT                                                  NOT NULL CHECK (LENGTH(bemerkung) >= 5),
    `sternbewertung`      ENUM ('sehr gut', 'gut', 'schlecht', 'sehr schlecht') NOT NULL,
    `bewertungszeitpunkt` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `hervorgehoben`       BOOLEAN   DEFAULT FALSE,
    FOREIGN KEY (benutzer_id) REFERENCES benutzer (id),
    FOREIGN KEY (gericht_id) REFERENCES gericht (id)
);


INSERT INTO bewertung (benutzer_id, gericht_id, bemerkung, sternbewertung, hervorgehoben)
VALUES (8, 1, 'SIUUUUUUUUUUUUU', 'sehr gut', FALSE),
       (1, 6, 'nicht schlimm!', 'gut', TRUE),
       (10, 19, 'ich kann das besser machen!!!!', 'schlecht', FALSE),
       (3, 4, 'Das war nichts für mich', 'sehr schlecht', FALSE),
       (4, 9, 'Einfach lecker!!', 'sehr gut', FALSE);
