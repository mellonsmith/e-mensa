<?php
    function db_benutzer_verifizieren($email){
        try {

            $link = connectdb();
            mysqli_begin_transaction($link);

            $sql = "SELECT passwort, name, id FROM benutzer WHERE email = '$email' ";
            $result = mysqli_query($link, $sql);

            $data = mysqli_fetch_all($result, MYSQLI_BOTH);
            mysqli_commit($link);
            mysqli_close($link);

        }
        catch (Exception $ex) {
            $data = array(
                'id'=>'-1',
                'error'=>true,
                'name' => 'Datenbankfehler '.$ex->getCode(),
                'beschreibung' => $ex->getMessage());
        }
        finally {
            return $data;
        }
    }
function db_benutzer_angemeldet($email, $id) {
    $link = connectdb();
    mysqli_begin_transaction($link);

    $sql = "CALL neueAnmeldung ($id)";
    mysqli_query($link, $sql);

    $sql1 = "UPDATE benutzer SET letzteanmeldung = NOW() WHERE email = '$email' ";
    mysqli_query($link, $sql1);

    mysqli_commit($link);
    mysqli_close($link);
}
function db_benutzer_fehler($email){
    $link = connectdb();
    mysqli_begin_transaction($link);

    $sql = "UPDATE benutzer SET letzterfehler = NOW() WHERE email = '$email' ";
    mysqli_query($link, $sql);

    mysqli_commit($link);
    mysqli_close($link);
}

function db_benutzer_bewertung($review, $user, $stars, $gerichtid){
    $link = connectdb();
    mysqli_begin_transaction($link);

    $sql1 = "SELECT id FROM benutzer WHERE name = '$user' ";
    $result = mysqli_query($link, $sql1);

    $userid = mysqli_fetch_all($result, MYSQLI_BOTH)[0][0];

    $sql2 = "INSERT INTO bewertung (bemerkung, bewertungszeitpunkt , sterne_bewertung, hervorgehoben, gericht_id, benutzer_id) VALUES ('$review', NOW(), '$stars', '0', '$gerichtid', '$userid')";

    mysqli_query($link, $sql2);

    mysqli_commit($link);
    mysqli_close($link);
}