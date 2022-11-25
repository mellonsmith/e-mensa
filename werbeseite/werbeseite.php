<!DOCTYPE html>
<!--
- Praktikum DBWT. Autoren:
- Luis, Scholten, 3518159
- Jonathan, Plum, 3524464
-->
<?php
include 'gerichte.php';

$link = mysqli_connect(
    "localhost", // Host der Datenbank
    "root", // Benutzername zur Anmeldung
    "123", // Passwort zur Anmeldung
    "emensawerbeseite" // Auswahl der Datenbank
); // Optional: Port der Datenbank,
// falls nicht 3306 verwendet wird
if (!$link) {
    echo "Verbindung zur Datenbank fehlgeschlagen: ", mysqli_connect_error();
    exit();
}
$ipAdr = $_SERVER['SERVER_ADDR'];

$sql5 = "INSERT INTO besucher (ip) VALUES ('$ipAdr')";
mysqli_query($link, $sql5);
const POST_WUNSCHGERICHT = 'wunschgericht';
const POST_VORNAME = 'vorname';
const POST_LANGUAGE = 'language';
const POST_EMAIL = 'email';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if($_POST[POST_WUNSCHGERICHT] == null){

        $vorname = $_POST[POST_VORNAME];
        $email = $_POST[POST_EMAIL];
        $language = $_POST[POST_LANGUAGE];
        $sql4 = "INSERT INTO newsletteranmeldungen (vorname, email, language) VALUES ('$vorname', '$email', '$language')";
        mysqli_query($link, $sql4);
    } else {
        $wunschgericht = $_POST[POST_WUNSCHGERICHT];
        $sql6 = "SELECT name FROM wunschgericht WHERE name = $wunschgericht";
        $result4 = mysqli_query($link, $sql6);
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
<?php
?>
    <div class="navbar">
        <div class="grid-con"  >
            <div><img class="icon" src="favicon.png" alt="E-Mensa"></div>
            <div>
                <ul class="myheader">
                    <li class="Headerel"><a href="#CA">Ankündigung</a></li>
                    <li class="Headerel"><a href="#CS">Speisen</a></li>
                    <li class="Headerel"><a href="#CZ">Zahlen</a></li>
                    <li class="Headerel"><a href="#CK">Kontakt</a></li>
                    <li class="Headerel"><a href="#CW">Wichtig für uns</a></li>
                </ul>
            </div>
            <div></div>
        </div>
        <div class="trenner" ></div>
    </div>
    <br><br>
    <div class="grid-con">
        <div></div>
        <div>
            <img alt="placeholder" src="French-fries.webp" style="height:20%; width:40%;">
            <h1 id="CA">Bald könnt ihr online Essen bestellen!</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc condimentum, nibh vel bibendum blandit, ante orci auctor magna, quis sodales felis nulla eu tortor. Fusce volutpat, lorem finibus porttitor commodo, sapien ligula imperdiet lacus, vitae fermentum nisl tellus nec orci. In porta est ut ornare euismod. Donec sit amet enim iaculis, vulputate turpis porta, lacinia libero. Sed vel bibendum justo. Vestibulum et erat mattis, sollicitudin leo scelerisque, molestie ante. In eget quam facilisis, iaculis urna vitae, pellentesque arcu. Aenean malesuada a eros mattis ornare. Curabitur interdum risus ligula, in vestibulum dui venenatis vel. Proin aliquet aliquam congue. Phasellus ante lectus, placerat ac blandit ac, ultricies vitae lectus. Suspendisse sit amet risus mollis, rutrum leo faucibus, semper velit. <br> <br>Vestibulum pretium, erat eu porttitor posuere, leo ipsum lacinia est, quis tincidunt lectus nulla a lacus. Quisque ut purus diam. Fusce semper lectus a mauris viverra elementum. Pellentesque at malesuada magna. Fusce quis quam nunc. Morbi eu lorem iaculis, convallis purus sit amet, commodo massa. Praesent tincidunt neque lacus, nec fermentum ligula pulvinar non. Nullam ullamcorper at nunc quis ultricies. Sed quis ex dui. Nunc lobortis egestas erat, eget malesuada eros. Donec non ante ut nibh congue molestie. </p>
            <br><h1 id="CS">Köstlichkeiten die sie erwarten</h1>
            <table>
                <tr>
                    <th>Gericht</th>
                    <th>Preis Intern</th>
                    <th>Preis Extern</th>
                    <th>Allergene</th>
                </tr>
                <?php

                $sql = "SELECT name, preis_intern, preis_extern, id FROM gericht ORDER BY name ASC LIMIT 5 ";
                $result = mysqli_query($link, $sql);
                $allergenArr = Array();
                while($row = mysqli_fetch_row($result)){
                    $sql1 = "SELECT code FROM gericht_hat_allergen WHERE gericht_id = $row[3] ";
                    $result1 = mysqli_query($link, $sql1);

                    echo '<tr>';
                    echo '<td>' . $row[0] . '</td>';
                    echo '<td>' . $row[1] . '</td>';
                    echo '<td>' . $row[2] . '</td>';
                    echo '<td>';
                    while($allergen = mysqli_fetch_row($result1)){
                        foreach ($allergen as $alge){
                            array_push($allergenArr, $alge);
                            echo $alge . ',';
                        }
                    }
                    echo '</td>';
                    echo '</tr>';
                }
                foreach (array_unique($allergenArr) as $alge) {
                    $sql2 = "SELECT name FROM allergen WHERE code = '$alge'";
                    $result2 = mysqli_query($link, $sql2);
                    while($row = mysqli_fetch_row($result2)){
                        echo $alge . ": " . $row[0] . "; ";
                    }
                }
                ?>
            </table><br>

            <h1 id="CZ">
                E-Mensa in Buchstaben
            </h1>
            <ul class="myheader">
                <h2>
                    <li class="Headerel">
                        <?php
                        $sql3 = "SELECT COUNT(ip) FROM besucher";
                        $result3 = mysqli_query($link, $sql3);
                        $anzahlGerichte = mysqli_fetch_row($result3);
                        echo $anzahlGerichte[0];
                        ?>
                            Besuche</li>
                    <li class="Headerel"> <?php
                        $sql3 = "SELECT COUNT(email) FROM newsletteranmeldungen";
                        $result3 = mysqli_query($link, $sql3);
                        $anzahlGerichte = mysqli_fetch_row($result3);
                        echo $anzahlGerichte[0];
                        ?>  Anmeldungen zum Newsletter</li>
                    <li class="Headerel"><?php
                        $sql3 = "SELECT COUNT(id) FROM gericht";
                        $result3 = mysqli_query($link, $sql3);
                        $anzahlGerichte = mysqli_fetch_row($result3);
                        echo $anzahlGerichte[0];
                        ?> Speisen</li>
                </h2>
            </ul><br>
            <h1 id="CK">
                Interesse geweckt? Wir informieren Sie!
            </h1>
            <form  method="post" id="submit" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <fieldset>
                    <legend>Newsletter</legend>
                    <div class="form-grid">
                        <div>
                            <label for="firstnameID"> Vorname*</label><br>
                            <input name="vorname" type="text" size="34" required="required" placeholder="Bitte gib deinen Namen ein" id="firstnameID">
                            <br><br>
                            <label for="MenuID"> Sprache*</label><br>
                            <select id="MenuID" name="language">
                                <option value="deutsch">Deutsch</option>
                                <option value="englisch">Englisch</option>
                                <option value="elbisch">Elbisch</option>
                            </select> <br>

                        </div>
                        <div>
                            <label for="MailID"> Email*</label><br>
                            <input name="email" type="email" size="34" required="required" placeholder="Bitte geben Sie Ihre E-Mail ein" id="MailID">
                            <br><br>
                            <input type="checkbox" id="datenschutzID" required="required">
                            <label for="datenschutzID">Datenschutzhinweise gelesen?</label>
                            <p2>*) Eingaben sind Pflicht</p2><br>
                            <input class="right-button" type="submit" id="submit" value="Abschicken">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" id="submit1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <fieldset>
                    <legend>Wunschgericht</legend>
                    <div class="form-grid">
                        <div>
                            <label for="wunschgerichtnameID"> Welches Gericht wünschen Sie sich?</label>
                            <input name="wunschgericht", required="required", placeholder="Bitte geben Sie ein Gericht ein.", id="wunschgerichtnameID">
                            <br>
                            <input class="right-button" type="submit" id="submit1" value="Wunsch abschicken">
                        </div>
                    </div>
                </fieldset>
            </form>
            <?php
            if($result4 != null){
                echo "<div>ausgewähltes Wunschgericht: . $result4</div>";

            }
            ?>


            <br>
            <h1 id="CW">Das ist uns wichtig: </h1>
            <ul class="liste">
                <li>Beste, tiefgekühlte Zutaten.</li>
                <li>Aus deutschen Kartoffeln</li>
                <li>In absurden Mengen pflanzlichem Fett fritiert. </li>
            </ul>
            <br>
            <h1>Wir freuen uns auf ihren besuch.</h1>
        </div>

        <div></div>
    </div>
    <div class="trenner"></div>

    <h3>(c) E-Mensa GmbH  <gap> | </gap>  Luis Scholten, Jonathan Plum  <gap> | </gap>  <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">Impressum</a></h3>

</body>
</html>