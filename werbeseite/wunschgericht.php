<?php
$link = mysqli_connect(
    "localhost", // Host der Datenbank
    "root", // Benutzername zur Anmeldung
    "123", // Passwort zur Anmeldung
    "emensawerbeseite" // Auswahl der Datenbank
); // Optional: Port der Datenbank,

if (!$link) {
    echo "Verbindung zur Datenbank fehlgeschlagen: ", mysqli_connect_error();
    exit();
}
const POST_NAME = 'name';
const POST_BESCHREIBUNG = 'beschreibung';
const POST_ERSTELLUNGSDATUM = 'erstellungsdatum';
const POST_EMAIL = 'email';
const POST_ERSTELLERNAME = 'erstellername';
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $beschreibung = $_POST[POST_BESCHREIBUNG];
    $name = $_POST[POST_NAME];
    $email = $_POST[POST_EMAIL];
    $erstellerName = $_POST[POST_ERSTELLERNAME];
    $date = date("Y/m/d");
    $sql1 = "SELECT id FROM ersteller WHERE email = '$email'";
    $result1 = mysqli_fetch_row(mysqli_query($link, $sql1));
    if ($result1){

        $sql = "INSERT INTO wunschgericht (name, beschreibung, e_id, erstellungsdatum) VALUES ('$name', '$beschreibung', '$result1[0]', '$date')";
        $result = mysqli_query($link, $sql);

        echo "wunschgericht erstellt";
    } else {
        $sql2 = "INSERT INTO ersteller (name, email) VALUES ('$erstellerName', '$email')";
        $result2 = mysqli_query($link, $sql2);
        $sql3 = "SELECT id FROM ersteller WHERE email = '$email'";
        $result3 = mysqli_fetch_row(mysqli_query($link, $sql3));
        $sql4 = "INSERT INTO wunschgericht (name, beschreibung, e_id, erstellungsdatum) VALUES ('$name', '$beschreibung', '$result3[0]', '$date')";
        $result4 = mysqli_query($link, $sql4);
    }


}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mensa La Familia</title>
    <link rel="icon" type="image/x-icon" href="favicon.png">
    <style>
        .grid-con {
            display: grid;
            grid-template-columns: 15% auto 15% ;
            gap: 10px;

        }
        .right-button {
            float: right;
            width: 140px;
            height: 40px;
            text-align: center;
            font-weight: bold;
            font-size: 16px;
        }
        select {
            width:120px;
        }
        .form-grid {
            display: grid;
            grid-template-columns: auto auto;
            gap: 10px;
        }
        gap {
            color: gray;
            font-size: 38px;

        }
        .icon {
            width: 30%;
        }
        .Headerel {
            display: inline-block;
            margin-inline: 4%;
        }
        .myheader {
            text-align: center;
        }
        .trenner {
            border-top: 2px solid dimgray;
        }
        img {
            display:block;
            margin-left: auto;
            margin-right: auto;

        }
        h1 {
            text-align: center;
        }
        p {
            border: 1px solid black;
            text-align: justify;
        }
        table{
            width: 100%;
        }
        table, td, th {
            border: 1px solid black;
            border-collapse: collapse;
        }
        p2 {
            float: right;
        }
        .liste {
            text-align: center;
            font-weight: bold;
            font-size: 18px;
        }
        h3 {
            text-align: center;

        }
        .navbar {
            overflow: hidden;
            background-color: white;
            position: fixed;
            top: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <form method="post" id="submit1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <fieldset>
                <legend>Wunschgericht</legend>
                <div class="form-grid">
                    <div>
                        <label for="nameID"> Welches Gericht wünschen Sie sich?</label>
                        <input name="name", required="required", placeholder="", id="nameID">
                        <br>
                        <label for="beschreibungID"> Beschreiben sie das Gericht: </label>
                        <input name="beschreibung", required="required", placeholder="", id="beschreibungID">
                        <br>
                        <label for="erstellernameID"> Ihr Name: </label>
                        <input name="erstellername", required="required", placeholder="", id="erstellernameID">
                        <br>
                        <label for="emailID"> Ihre E-Mail Adresse: </label>
                        <input name="email", required="required", placeholder="", id="emailID">
                        <br>
                        <input class="right-button" type="submit" id="submit1" value="Wunsch abschicken">
                    </div>
                </div>
            </fieldset>
    </form>
</body>