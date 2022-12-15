<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/benutzer.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../public/index.php');
const POST_EMAIL = 'email';
const POST_PASSWORT = 'passwort';

/* Datei: controllers/HomeController.php */
class HomeController
{
    public string $error = "";

    public function index(RequestData $request) {
        session_start();
        if($_SESSION['user'] == NULL) $_SESSION['user'] = "nouser";
        $gericht = db_gericht_select5();
        $logger = logger();
        $logger->info('Zugriff auf die Hauptseite');
        return view('werbeseite', [
            'rd' => $request,
            'gericht' => $gericht,
            'username' => $_SESSION['user']
            ]);

    }
    public function anmeldung(RequestData $request){

        return view('anmeldung', [
            'rd' => $request,
            'error' => $this->error
        ]);
    }
    public function abmelden(RequestData $request){
        $logger = logger();
        $logger->info('Erfolgreich abgemeldet');
        session_start();
        session_destroy();
        header('Location: /'); exit();
    }
    public function anmeldung_verifizieren(RequestData $request){
        $logger = logger();
        $r = $request->getPostData();
        $this->error = "";
        $email = $passwort = "";
        $encrypted = 0;

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $r['email'];
            $passwort = $r['password'];
            $salt = "salz";
            $encrypted = sha1($salt.$passwort);
        }

        $data = db_benutzer_verifizieren($email);
        $id = $data[0]['id'];
        if(!$data) {
            $logger->warning('Fehlgeschlagene Anmeldung');
            $this->error = "Email konnte nicht gefunden werden";
            header('Location: /anmeldung'); exit();
        }
        else if($data[0]['passwort'] == $encrypted){
            session_start();
            $logger->info('Erfolgreich angemeldet');
            db_benutzer_angemeldet($email, $id);
            $_SESSION['user'] = $data[0]['name'];
            header('Location: /'); exit();
        } else{
            $logger->warning('Fehlgeschlagene Anmeldung');
            db_benutzer_fehler($email);
            $this->error = "Falsches Passwort";
            header('Location: /anmeldung'); exit();
        }
    }
}
