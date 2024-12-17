<?php

function db_updateBildname($directory)
{
    $link = connectdb();

    // Sicherstellen, dass der Ordner existiert
    if (!is_dir($directory)) {
        die ("Directory $directory existiert nicht");
    }

    //Alle Datei im Ordner abrufen
    $datei = array_diff(scandir($directory), ['.', '..']);


    foreach ($datei as $file) {
        //Sicherstellen, dass Dateien Bilder sind
        if (!preg_match('/\.(jpg|jpeg|gif|png|bmp)$/i', $file)) {
            continue;
        }

        //Dateien durch "_" teilen
        $dateiTeilen = explode("_", $file);

        // ID von Dateiennamen abrufen
        $id = $dateiTeilen[0];
        $dateiName = $file;

        //Aktualisieren Datenbank
        $stmt = $link->prepare("UPDATE gericht SET bildname = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("si", $dateiName, $id);
            $stmt->execute();

            $stmt->close();
        }
    }

    $link->close();

}

