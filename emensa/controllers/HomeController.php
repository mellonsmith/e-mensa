<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');

/* Datei: controllers/HomeController.php */
class HomeController
{
    public function index(RequestData $request) {
        $gericht = db_gericht_select5();
        return view('werbeseite', [
            'rd' => $request,
            'gericht' => $gericht
            ]);
    }
    
    public function debug(RequestData $request) {
        return view('debug');
    }
}