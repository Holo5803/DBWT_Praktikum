<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "gerichte"
 */
function db_gericht_select_all() {
    try {
        $link = connectdb();

        $sql = 'SELECT id, name, beschreibung FROM gericht ORDER BY name';
        $result = mysqli_query($link, $sql);

        $data = mysqli_fetch_all($result, MYSQLI_BOTH);

        mysqli_close($link);
    }
    catch (Exception $ex) {
        $data = array(
            'id'=>'-1',
            'error'=>true,
            'name' => 'Datenbankfehler '.$ex->getCode(),
            'beschreibung' => $ex->getMessage());
    }
    finally {
        return $data;
    }

}

function db_gericht_preisintern_mehr_als_2 (){
    $link = null;
    try {
        $link = connectdb();
        $sql = 'SELECT name, preisintern 
                FROM gericht
                WHERE preisintern  >2.0 
                ORDER BY name ASC';

        $stmt = $link->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = mysqli_fetch_all($result, MYSQLI_BOTH);

        $stmt -> close();

    }
    catch (Exception $ex) {
        $data = array(
            'error'=>true,
            'name' => 'Datenbankfehler '.$ex->getMessage(),
        );
    } finally {
        if ($link !== null) {
            return $data;
        }
    }
}

function db_gerichtAnzahl (){

    //Verbindung zur Datenbank
    $link = connectdb();
    //Prepare Statement zum Schützen vor SQl Injection
    $stmt = $link->prepare("SELECT COUNT(*) AS AnzahlGericht FROM gericht");
    //Ausführen der Abfrage
    if ($stmt->execute()){
        $result = $stmt->get_result();
        return $row = $result->fetch_assoc()['AnzahlGericht'];
    }
    else {
        error_log("Fehler beim Laden des Gerichtes aufgetreten". $stmt->error);
    }

    return 0;
}

function db_gerichtAllergen (string $sortOrder = 'asc'){
    $data = [];
    $link = null;
    try{
        $link = connectdb();

        $sortOrder = ($sortOrder == 'asc') ? 'asc' : 'desc';

        //SQL-Statement vorbereiten und ausführen
        $sql  = "
            SELECT gericht.name, gericht.preisintern, gericht.preisextern, gericht.bildname, GROUP_CONCAT(allergen.code SEPARATOR ', ') AS Allergen
            FROM gericht 
            LEFT JOIN gericht_hat_allergen ON gericht.id = gericht_hat_allergen.gericht_id
            LEFT JOIN allergen ON gericht_hat_allergen.code = allergen.code
            GROUP BY gericht.id
            ORDER BY name $sortOrder 
            LIMIT 5";

        $stmt = $link->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        //Ergebnisse in Array laden
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        $stmt->close(); //Resource freigegeben
    }
    catch (Exception $ex) {
        //Fehler abfangen
        $data = [
            'error'=>true,
            'message' => 'Datenbankfehler '.$ex->getMessage(),
        ];
    }
    finally {

        // Verbindung schließen
        if ($link !== null) {
            $link -> close();
        }
        return $data;
    }





}
