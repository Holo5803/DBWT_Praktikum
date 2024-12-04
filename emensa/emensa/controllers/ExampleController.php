<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/kategorie.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
use http\QueryString;

class ExampleController
{
    public function m4_6a_queryparameter(RequestData $rd) {
        /*
           Wenn Sie hier landen:
           bearbeiten Sie diese Action,
           sodass Sie die Aufgabe löst
        */

        return view('notimplemented', [
            'request'=>$rd,
            'url' => 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"
        ]);
    }

    public function m4_7a_queryparameter(RequestData $rd) {
        $name = $rd->query['name'] ?? "Unbekannt";
        return view('examples.m4_7a_queryparameter',
            ['name' => $name]);
    }

    public function m4_7b_kategorie() {
        $kategorien = db_kategorie_select_all();

        return view('examples.m4_7b_kategorie',
            ['kategorien' => $kategorien]);
    }

    public function m4_7c_gerichte(){
        $gerichte = db_gericht_preisintern_mehr_als_2();
        return view('examples.m4_7c_gerichte',
            ['gerichte' => $gerichte]);
    }
}