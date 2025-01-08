<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/bewertungen.php');

class BewertungController
{
    public function bewertungsForm(RequestData $requestData)
    {
        $gerichtID = $_GET['gerichtid'] ?? null;
        //Checken, ob der User schon angemeldet ist
        if (!isset($_SESSION['id'])) {
            $_SESSION['redirect_nach_login'] = '/bewertung?gerichtid=' . $gerichtID;
            header('Location: /anmelden');
            exit();
        }

        //Gerichtsdetails mit `gerichtid` aus dem Abfrageparameter abrufen
        $gericht = [];
        if ($gerichtID) {
            $gericht = db_bewertungen($gerichtID);
        }

        return view('bewertungForm', [
            'gericht' => $gericht ?? null
        ]);
    }

    public function bewertungFormSubmit(RequestData $requestData)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $benutzerID = $_SESSION['id'];
            $gerichtID = $_POST['gerichtid'] ?? null;
            $bemerkung = trim($_POST['bemerkung']);
            $sternbewertung = $_POST['sternbewertung'];

            //Eingabewerte Prüfung
            if (strlen($bemerkung) < 5) {
                $_SESSION['error_message'] = "Bemerkung muss mindestens 5 Zeichen lang sein!";
                header('Location: /bewertung?gerichtid = $gerichtID');
                exit();
            }

            //Bewertung in Datenbank einfügen
            db_bewertungenSubmit($benutzerID, $gerichtID, $bemerkung, $sternbewertung);
            header('Location: /');
            exit();

        }
        return view('bewertungForm', [
            'gericht' => $gericht ?? null,
        ]);
    }

    public function showBewertungen()
    {
        $bewertungen = db_bewertungenAnzeigen();
        return view('bewertungen', [
            'bewertungen' => $bewertungen
        ]);
    }

    public function meineBewertungen()
    {
        $benutzerID = $_SESSION['id'];
        $meineBewertungen = db_meineBewertungenAnzeigen($benutzerID);
        return view('meineBewertungen', [
            'meineBewertungen' => $meineBewertungen
        ]);
    }

    public function deleteBewertungen()
    {
        $id = $_GET['bewertungsID'];
        $benutzerID = $_SESSION['id'];
        db_deleteBewertung($id, $benutzerID);
        header('Location: /meinebewertungen');
        exit();
    }

    public function toggleBewertung()
    {
        if (!isset($_SESSION['id']) || !$_SESSION['admin']) {
            header('Location: /anmelden');
        }
        $bewertungsID = $_GET['bewertungsID'] ?? null;

        if ($bewertungsID) {
            $bewertung = db_toggleBewertung($bewertungsID);
            if ($bewertung) {
                $hervorgehoben = !$bewertung['hervorgehoben'];
                db_hervorgehobenUmschalten($hervorgehoben, $bewertungsID);
            }

        }

        header('Location: /bewertungen');
        exit();
    }


}