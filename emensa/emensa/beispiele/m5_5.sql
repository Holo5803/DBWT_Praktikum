USE emensawerbeseite;

CREATE PROCEDURE benutzerAnzahlanmeldung_inkrement(IN user_id INT)
BEGIN
    UPDATE benutzer
    SET anzahlanmeldungen = anzahlanmeldungen + 1,
        letzterfehler     = NOW()
    WHERE id = user_id;
END;

INSERT INTO benutzer (name, email, passwort, admin, anzahlanmeldungen, anzahlfehler, letzteanmeldung, letzterfehler)
VALUES ('test_user1', 'ducnguyen@gmail.com', 'efbf0939742e65add3706a69c645788ce4793ec7a820bf415a8f8d7b07293566', 0,0, 0,NULL, NULL);

INSERT INTO benutzer (name, email, passwort, admin, anzahlanmeldungen, anzahlfehler, letzteanmeldung, letzterfehler)
VALUES ('test_user2', 'andihueppi@gmail.com', '403ca6a8c5af8e97302d51fa002f614eaf407ae6203ec456640a76f0e146fe40', 0,0, 0,NULL, NULL);


