<?php
function db_bewertungen($gerichtid)
{
    //Verbindung zur Datenbank
    $link = connectdb();

    $stmt = $link->prepare("SELECT name, bildname FROM gericht WHERE id = ?");
    $stmt->bind_param("i", $gerichtid);
    $stmt->execute();
    $gericht = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    $link->close();

    return $gericht;
}

function db_bewertungenSubmit($benutzerID, $gerichtID, $bemerkung, $sternbewertung)
{
    $link = connectdb();
    $stmt = $link->prepare("INSERT INTO bewertung (benutzer_id, gericht_id, bemerkung, sternbewertung) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $benutzerID, $gerichtID, $bemerkung, $sternbewertung);
    $stmt->execute();
    $stmt->close();
    $link->close();

    return "Bewertung wurde erfolgreich erstellt.";
}

function db_bewertungenAnzeigen()
{
    $link = connectdb();
    $result = $link->query("SELECT bewertung.*, gericht.name AS gericht_name, benutzer.name AS benutzer_name, admin 
                                FROM bewertung
                                JOIN gericht ON bewertung.gericht_id = gericht.id
                                JOIN benutzer ON bewertung.benutzer_id = benutzer.id
                                ORDER BY bewertungszeitpunkt DESC
                                LIMIT 30");
    $bewertungen = $result->fetch_all(MYSQLI_ASSOC);

    return $bewertungen;
}

function db_meineBewertungenAnzeigen($benutzerID)
{
    $link = connectdb();
    $stmt = $link->prepare("SELECT bewertung.*, gericht.name AS gericht_name
                                FROM bewertung
                                JOIN gericht ON bewertung.gericht_id = gericht.id
                                WHERE benutzer_id = ?
                                ORDER BY bewertungszeitpunkt DESC
                               ");
    $stmt->bind_param("i", $benutzerID);
    $stmt->execute();
    $result = $stmt->get_result();
    $bewertungen = $result->fetch_all(MYSQLI_ASSOC);


    return $bewertungen;

}

function db_deleteBewertung($id, $benutzerID)
{
    $link = connectdb();
    $stmt = $link->prepare("DELETE FROM bewertung WHERE id = ? AND benutzer_id = ?");
    $stmt->bind_param("ii", $id, $benutzerID);
    $stmt->execute();
    $stmt->close();
}

function db_toggleBewertung($id)
{
    $link = connectdb();
    $stmt = $link->prepare("SELECT hervorgehoben FROM bewertung WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $bewertung = $result->fetch_assoc();
    $stmt->close();

    return $bewertung;
}

function db_hervorgehobenUmschalten($hervorgehoben, $bewertungsID)
{
    $link = connectdb();
    $stmt = $link->prepare("UPDATE bewertung SET hervorgehoben = ? WHERE id = ?");
    $stmt->bind_param("ii", $hervorgehoben, $bewertungsID);
    $stmt->execute();
    $stmt->close();
}

function db_highlightAnzeigen()
{
    $link = connectdb();
    $result = $link->query("SELECT bewertung.*, gericht.name AS gericht_name, benutzer.name AS benutzer_name, admin 
                                FROM bewertung
                                JOIN gericht ON bewertung.gericht_id = gericht.id
                                JOIN benutzer ON bewertung.benutzer_id = benutzer.id
                                WHERE hervorgehoben = 1
                                ORDER BY bewertungszeitpunkt DESC
                                LIMIT 30");
    $bewertungen = $result->fetch_all(MYSQLI_ASSOC);

    return $bewertungen;
}

