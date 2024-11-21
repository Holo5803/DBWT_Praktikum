<?php
/**
 * Praktikum DBWT. Autoren:
 * Andreas, Hüpgen, 3679869
 * Viet Minh Duc, Nguyen, 3659300
 */

$datum = date('d.m.Y H:i:s');
$webbrowser = $_SERVER['HTTP_USER_AGENT'];
$clientIP = $_SERVER['REMOTE_ADDR'];

// Add a newline character at the end of each log entry
$logEntry = "$datum, $webbrowser, $clientIP\n";

$eintrag = fopen('accesslog.txt', 'a');
if (!$eintrag) {
    die('Öffnen fehlschlagen!');
}

// Write the log entry with a newline
fwrite($eintrag, $logEntry);
fclose($eintrag);



?>


