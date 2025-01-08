<?php
define('mein_salz', 'dbwt_m5');

$passwort = 'passwort_ist_mega_stark';
$passwort1 = 'dbwt ist cool';
$passwort2 = 'dbwt_schwer?';
$passwort3 = 'dbwt_schwer3?';
$passwort4 = 'dbwt_schwer4?';
$passwort5 = 'dbwt_schwer5?';
$passwort6= 'dbwt_schwer6?';
$passwort7 = 'dbwt_schwer7?';
$passwort8 = 'dbwt_schwer8?';
$passwort9 = 'dbwt_schwer9?';

$hashPasswort = hash('sha256', mein_salz.$passwort9);

//echo "Hash Passwort: ".$hashPasswort."<br>";