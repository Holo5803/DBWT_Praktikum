<?php
function db_wunschgericht($name, $email, $gericht_name, $beschreibung)
{

//Verbindung zur Datenbank
    $link = connectdb();

    $sql_ersteller = "INSERT INTO ersteller (name, email) VALUES (?, ? ) ON DUPLICATE KEY UPDATE id= LAST_INSERT_ID(id);";
    $stmt = $link->prepare($sql_ersteller);
    $stmt->bind_param("ss", $name, $email);
    $stmt->execute();
    $ersteller_id = $stmt->insert_id;

    //Wunschgericht einfügen
    $sql_gericht = "INSERT INTO wunschgericht (name, beschreibung, ersteller_id) VALUES (?, ?, ?)";
    $stmt = $link->prepare($sql_gericht);
    $stmt->bind_param("ssi", $gericht_name, $beschreibung, $ersteller_id);
    $stmt->execute();

    $stmt->close();
    $link->close();

    return "Wunschgericht wurde erfolgreich erstellt!";


}