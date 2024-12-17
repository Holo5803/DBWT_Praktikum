<?php
function allergenCode()
{
    //Verbindung zur Datenbank
    $link = connectdb();
    //Prepare Statement zum Schützen vor SQl Injection
    $stmt = $link->prepare("SELECT code, name FROM allergen;");


    //Ausführen der Abfrage
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // Array für Allergene
            $allergene = [];

            // Wenn Allergene vorhanden sind, durchlaufen und in ein Array speichern
            while ($row = $result->fetch_assoc()) {
                $allergene[] = htmlspecialchars($row['code'] . ": " . $row['name']);
            }
            return $allergene;
        }
        return [];

    } else {
        error_log("Fehler beim Laden des Gerichtes aufgetreten" . $stmt->error);
    }

    return [];
}
