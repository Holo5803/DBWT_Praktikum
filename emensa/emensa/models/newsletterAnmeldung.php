<?php
function anmeldenNewsletter($name, $email, $verbotene_domain, $zustimmen, $sprache)
{

    $fehler = [];

    //Cheken ob Namefeld leer ist
    if (empty($name)) {
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

    if (!$zustimmen) {
        $fehler[] = "Bitte stimmen sie den Datenschutzbestimmungen ein";
    }

    if (empty($fehler)) {
        $datum = date("Y-m-d H:i:s");
        $nutzer_daten = $name . "," . $email . "," . $sprache . "," . $datum;
        $file = '../storage/newsletter_anmeldung.txt';

        //Schreiboperation
        if (file_put_contents($file, $nutzer_daten . "\n", FILE_APPEND | LOCK_EX) !== false) {
            return [];
        } else {
            $fehler[] = "Ihre Daten können nicht gespeichert werden.";
        }
    }

    return $fehler;
}