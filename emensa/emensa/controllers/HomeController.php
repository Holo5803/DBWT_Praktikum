<?php


require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/gericht.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/besucher.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/allergen.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/kategorie.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../helpers/CustomSessionHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/newsletterAnmeldung.php');
require_once $_SERVER['DOCUMENT_ROOT'] . '/../models/gerichtebilder.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../models/bewertungen.php';


/* Datei: controllers/HomeController.php */

class HomeController
{
    private $sessionHandler;

    public function __construct()
    {
//        session_start(); // Start PHP session
        $this->sessionHandler = new CustomSessionHandler();
    }

    public function index(RequestData $request)
    {

        $sortOrder = $request->query['sort'] ?? 'asc';
        $meals = db_gerichtAllergen($sortOrder);
        $anzahlGerichte = db_gerichtAnzahl();
        $allergenCode = sizeof(allergenCode()) > 0 ? implode(', ', allergenCode()) : "Keine Allergen";

        $anzahlBesucher = getAnzahlBesucher();
        $confirmationMessage = $this->subscribe($request);

        $directory =  '../public/img/gerichte/';
        db_updateBildname($directory);

        $log = logger();

        $log->info('Main page accessed', ['time' => date('d.m.Y H:i:s')]);
        $highlights = db_highlightAnzeigen();

        return view('home', [
            'rd' => $request,
            'meals' => $meals,
            'anzahlAnmeldung' => $this -> sessionHandler ->getSessionValue('anmeldung', 0),
            'anzahlGerichte' => $anzahlGerichte,
            'anzahlBesucher' => $anzahlBesucher,
            'allergenCode' => $allergenCode,
            'highlights' => $highlights,
            'confirmationMessage' => $confirmationMessage
        ]);

    }

    public function subscribe(RequestData $request)
    {
        $verbotene_domain =
            [
                'wegwerfmail', 'trashmail'
            ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Input Date zugreifen
            $name = trim($_POST['vorname'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $sprache = trim($_POST['sprache'] ?? '');
            $zustimmen = isset($_POST['datenschutz']) ? 'Ja' : 'Nein';

            $fehler = anmeldenNewsletter($name, $email, $verbotene_domain, $zustimmen, $sprache);

            if (sizeof($fehler) == 0) {
                $this->sessionHandler->incrementSessionCount('anmeldung');
                return "Vielen Dank für Ihre Anmeldung.";
            } else {
                return "Fehler: Die Datei konnte nicht beschreiben werden. Bitte überprüfen Sie die Dateiberechtigungen." . implode('\n ', $fehler);
            }
        }
        return "";
    }

    public
    function debug(RequestData $request)
    {
        return view('debug');
    }

}