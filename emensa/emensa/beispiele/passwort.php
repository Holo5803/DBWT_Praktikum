<?php
define('mein_salz', 'dbwt_m5');

$passwort = 'passwort_ist_mega_stark';
$passwort1 = 'dbwt ist cool';
$passwort2 = 'dbwt_schwer?';

$hashPasswort = hash('sha256', mein_salz.$passwort2);

//echo "Hash Passwort: ".$hashPasswort."<br>";