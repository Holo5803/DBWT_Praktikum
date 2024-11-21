<?php
/**
 * Praktikum DBWT. Autoren:
 * Andreas, Hüpgen, 3679869
 * Viet Minh Duc, Nguyen, 3659300
 */

echo '<form method ="get">
       <label for="suche">Suchwort eingeben:</label>
       <input type="Text" name="suche" id="suche"/>
       <br>
       
       <button type="submit">Suchen</button>
       </form>';

if (isset($_GET['suche'])) {
    $suchwort = $_GET['suche'];
    $found = false;


    $file = fopen('en.txt', 'r');
    if (!$file) {
        die ("Konnte nicht geladen werden!");
    }

    while (!feof($file)) {
        $line = fgets($file);
        list ($de, $eng) = explode(";", trim($line), 2);


        if (strcasecmp($suchwort, $de) == 0) {
            echo "Übersetzungstext von '$suchwort' : $eng";
            $found = true;
            break;
        }
    }

    fclose($file);

    if (!$found) {
        echo "Das gesuchte Wort '$suchwort' ist nicht enthalten";
    }
}
else {
    echo "Bitte geben Sie ein Suchwort an";
}