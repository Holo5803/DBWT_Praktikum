<?php
$verbotene_domain =
    [
        'wegwerfmail', 'trashmail'
    ];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     //Input Date zugreifen
    $name = trim ($_POST['vorname'] ?? '');
    $email = trim ($_POST['email'] ??'');
    $sprache = trim ($_POST['sprache'] ?? '');
    $zustimmen = isset($_POST['datenschutz']) ? 'Ja' : 'Nein';

    $fehler = [];

    //cheken ob Namefeld leer ist
    if(empty($name)){
        $fehler[] = 'Bitte geben Sie den Namen ein.';
    }

    //Checken ob Email korrekt formatiert ist
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Extract domain and check against prohibited domains
        $email_teil = explode('@', $email);
        $email_domain = $email_teil[1] ?? '';

        foreach ($verbotene_domain as $domain) {
            if (stripos($email_domain, $domain) !== false) {
                $fehler[] = "Ihre E-Mail-Adresse entspricht nicht den Vorgaben, bitte verwenden Sie eine andere E-Mail-Adresse.";
                break;
            }
        }
    }
//    elseif (preg_match('/@(wegwerfmail\.de|trashmail\.\w+)$/', $email)) {
//        $fehler[] = "Die Email Adresse darf nicht von wegwerfmail.de eingegeben werden.";
//    }

    if (!$zustimmen){
        $fehler[] = "Bitte stimmen sie den Datenschutzbestimmungen ein";
    }

    if(empty($fehler)){
        $datum = date ("Y-m-d H:i:s");
        $nutzer_daten = $name. "," . $email. "," . $sprache . "," . $datum;
        $file = 'newsletter.txt';

        //Schreiboperation
        if (file_put_contents($file, $nutzer_daten ."\n", FILE_APPEND | LOCK_EX) !== false) {
                if (!isset($_SESSION['anmeldung'])){
                $_SESSION['anmeldung'] = 0;
                }
                $_SESSION['anmeldung']++;
                $confirmationMessage = "<p>Vielen Dank für Ihre Anmeldung</p>";


        }
        else {
            $confirmationMessage = "<p>Fehler: Die Datei konnte nicht beschreiben werden. Bitte überprüfen Sie die Dateiberechtigungen.</p>";
        }
    }
    else {
        foreach ($fehler as $error) {
            $confirmationMessage .= "<p>$error</p>";
        }
    }
}

