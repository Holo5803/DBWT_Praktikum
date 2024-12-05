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

    public function m4_7d_layout(RequestData $rd) {
        $pageNumber = $rd->query['no'] ?? 1; // Standardseite ist Seite 1

        if ($pageNumber == 1) {
            return view('examples.pages.m4_7d_page_1', ['title' => 'Seite 1']);
        } elseif ($pageNumber == 2) {
            return view('examples.pages.m4_7d_page_2', ['title' => 'Seite 2']);
        } else {
            return view('examples.pages.m4_7d_page_1', ['title' => 'Seite 1']);
        }
    }



}