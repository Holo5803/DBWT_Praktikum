<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/wunschgericht.php');
class WunschgerichtController
{
    public function index(RequestData $request)
    {
        return view('wunsch_gerichte', [
            'rd' => $request,
            'message' => ""
        ]);
    }

    public function index2(RequestData $request)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $name = !empty(trim($_POST['ersteller_name'])) ? trim($_POST['ersteller_name']) : 'anonym';
            $email = trim($_POST['email']);
            $gericht_name = trim($_POST['gericht_name']);
            $beschreibung = trim($_POST['beschreibung']);

            db_wunschgericht($name, $email, $gericht_name, $beschreibung);


            return view('wunsch_gerichte', [
                'rd' => $request,
                'message' => "Wunschgericht wurde erfolgreich erstellt!"
            ]);
        }
    }
}