<?php
$salt = '1234'; // Salt (mindestens 4 Zeichen, zentral)
$passwort = 'DBWT2024DUC-ANDI'; // Wähle ein eigenes Passwort
$hash = sha1($salt . $passwort); // Hash generieren

echo "Hash: " . $hash;
?>
