<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/gericht.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/benutzer.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../public/index.php');
const POST_EMAIL = 'email';
const POST_PASSWORT = 'passwort';

/* Datei: controllers/HomeController.php */

class HomeController
{
    public string $error = "";

    public function index(RequestData $request)
    {
        session_start();
        if ($_SESSION['user'] == NULL) $_SESSION['user'] = "nouser";

        $gericht = db_gericht_select5();
        $logger = logger();
        $logger->info('Zugriff auf die Hauptseite');
        $logger->info('Admin: ' . $_SESSION['admin']);
        if ($_SESSION['kommtvon'] == NULL) $_SESSION['kommtvon'] = "Location: /";
        $_SESSION['kommtvon'] = "Location: /";
        return view('werbeseite', [
            'rd' => $request,
            'gericht' => $gericht,
            'username' => $_SESSION['user']
        ]);

    }

    public function bewertung(RequestData $request)
    {
        session_start();
        $gericht_id = $request->getGetData()['id'];
        $gerichtdata = db_gericht_data($gericht_id);
        $gerichtname = $gerichtdata[0]['name'];
        $gerichtbild = $gerichtdata[0]['bildname'];

        if ($_SESSION['user'] != "nouser") {
            return view('bewertung', [
                'gericht_id' => $gericht_id,
                'name' => $gerichtname,
                'bild' => $gerichtbild,
                'rd' => $request
            ]);
        } else {
            $_SESSION['kommtvon'] = "Location: /bewertung?id=" . $gericht_id;
            echo $_SESSION['kommtvon'];
            header('Location: /anmeldung');
            exit();
        }
    }

    public function submitreview(RequestData $request)
    {
        session_start();
        $r = $request->getPostData();
        $gerichtid = $r['gericht_id'];
        db_benutzer_bewertung(htmlspecialchars($r['review']), htmlspecialchars($_SESSION['user']), htmlspecialchars($r['stars']), htmlspecialchars($gerichtid));
        header('Location: /');
        return view('bewertung', [
            'rd' => $request
        ]);
    }

    public function anmeldung(RequestData $request)
    {
        $_SESSION['kommtvon'] = "Location: /";
        return view('anmeldung', [
            'rd' => $request,
            'error' => $this->error
        ]);
    }

    public function abmelden(RequestData $request)
    {
        $logger = logger();
        $logger->info('Erfolgreich abgemeldet');
        session_start();
        session_destroy();
        header('Location: /');
        exit();
    }
    public function bewertungen (RequestData $request){
        session_start();
        $data = db_benutzer_30bewertungen();

        return view('bewertungen', [
            'rd' => $request,
            'bewertungen' => $data,
            'admin' => $_SESSION['admin']
        ]);
    }
    public function meinebewertungen (RequestData $request){
        session_start();
        $data = db_benutzer_meinebewertungen($_SESSION['user']);
        $logger = logger();
        $logger->info('Reviews from ' . $_SESSION['user']);
        return view('meinebewertungen', [
            'rd' => $request,
            'bewertungen' => $data

        ]);
    }
    public function bewertungloeschen (RequestData $request){
        session_start();
        $r = $request->getPostData();
        $id = $r['id'];

        db_benutzer_bewertungLoeschen($id);
        header('Location: /meinebewertungen');
    }
    public function hervorheben (RequestData $request){
        session_start();
        $r = $request->getPostData();
        $id = $r['id'];
        $logger = logger();
        $logger->info('ID: ' . $id);
        db_benutzer_bewertungHervorheben($id);
        header('Location: /bewertungen');
    }

    public function anmeldung_verifizieren(RequestData $request)
    {
        $logger = logger();
        $r = $request->getPostData();
        $this->error = "";
        $email = $passwort = "";
        $encrypted = 0;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $r['email'];
            $passwort = $r['password'];
            $salt = "salz";
            $encrypted = sha1($salt . $passwort);
        }

        $data = db_benutzer_verifizieren($email);
        $id = $data[0]['id'];
        if (!$data) {
            $logger->warning('Fehlgeschlagene Anmeldung');
            $this->error = "Email konnte nicht gefunden werden";
            header('Location: /anmeldung');
            exit();
        } else if ($data[0]['passwort'] == $encrypted) {
            session_start();
            $logger->info('Erfolgreich angemeldet');
            db_benutzer_angemeldet($email, $id);
            $_SESSION['user'] = $data[0]['name'];
            $_SESSION['admin'] = $data[0]['admin'];
            header($_SESSION['kommtvon']);
            exit();
        } else {
            $logger->warning('Fehlgeschlagene Anmeldung');
            db_benutzer_fehler($email);
            $this->error = "Falsches Passwort";
            header('Location: /anmeldung');
            exit();
        }
    }
}
