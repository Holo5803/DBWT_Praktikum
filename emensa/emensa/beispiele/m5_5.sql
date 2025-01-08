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

INSERT INTO benutzer (name, email, passwort, admin, anzahlanmeldungen, anzahlfehler, letzteanmeldung, letzterfehler)
VALUES ('Mark Weider', 'weider@gmail.com', 'df61f15817b24f42c75efdff07e3ebb17aeea1b8d4b72e158533b5d20924597c', 0,0, 0,NULL, NULL);

INSERT INTO benutzer (name, email, passwort, admin, anzahlanmeldungen, anzahlfehler, letzteanmeldung, letzterfehler)
VALUES ('Philip Nguyen', 'flip@gmail.com', 'dc3de1a7e651e18cc58e36296f574bc98082a1ee93245080112d5f7e5e4d6bf6', 0,0, 0,NULL, NULL);

INSERT INTO benutzer (name, email, passwort, admin, anzahlanmeldungen, anzahlfehler, letzteanmeldung, letzterfehler)
VALUES ('Rafaelson', 'rafa@gmail.com', 'b3be6f8b3797a589da3881f193a79449d62ad8522867245f35f0d398bc042c24', 0,0, 0,NULL, NULL);

INSERT INTO benutzer (name, email, passwort, admin, anzahlanmeldungen, anzahlfehler, letzteanmeldung, letzterfehler)
VALUES ('Tony', 'tonyhoang@gmail.com', '5df5fe8bd23bc63ff802dce9a31fdca789c2ccbe6ff11075496b2fd920fea1a4', 0,0, 0,NULL, NULL);

INSERT INTO benutzer (name, email, passwort, admin, anzahlanmeldungen, anzahlfehler, letzteanmeldung, letzterfehler)
VALUES ('Cristiano Ronaldo', 'CR7@gmail.com', '0d845cc5f2872276c10407add9bb270b3c2641eb366cbe8a51b6cccb6c23efd2', 0,0, 0,NULL, NULL);

INSERT INTO benutzer (name, email, passwort, admin, anzahlanmeldungen, anzahlfehler, letzteanmeldung, letzterfehler)
VALUES ('Johnny', 'johnnydang@gmail.com', 'f22f52bd4bfd7300f35315df777d3204fcf77fa722a326afef0ad71279be2fa5', 0,0, 0,NULL, NULL);

INSERT INTO benutzer (name, email, passwort, admin, anzahlanmeldungen, anzahlfehler, letzteanmeldung, letzterfehler)
VALUES ('Van Dao', 'thu_vandao@gmail.com', 'de566110b6b24fd8aac77ec0c53be90011fc9d298340d5b0596d3c6f4b6505d0', 0,0, 0,NULL, NULL);

