<?php

function getAnzahlBesucher() {

    //Verbindung zur Datenbank
    $link = connectdb();
    //Prepare Statement zum Schützen vor SQl Injection
    $sql = "INSERT INTO besucher () VALUES ()";
    $link->query($sql);

    $sql = "SELECT COUNT(*) AS AnzahlBesucher FROM besucher";
    $result = $link->query($sql);
    $anzahlBesucher = $result->fetch_assoc()['AnzahlBesucher'];

    return $anzahlBesucher;




}

