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
