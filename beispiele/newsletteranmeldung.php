<?php
$vornameErr = $nachnameErr = $emailErr = $datenschutzErr = "";
$vorname = $nachname = $email = $datenschutz = $intervall = $gender = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $vorname = $_POST["vorname"];
    $nachname = $_POST["nachname"];
    $email = $_POST["email"];
    $datenschutz = $_POST["datenschutz"];
    $intervall = $_POST["intervall"];
    $gender = $_POST["GenderID"];

    if (empty($_POST["vorname"]) || $_POST["vorname"] == " ") {
        $vornameErr = "Vorname fehlt.";
    }
    if (empty($_POST["nachname"]) || $_POST["nachname"] == " ") {
        $nachnameErr = "Nachname fehlt.";
    }
    if (empty($_POST["email"])) {
        $emailErr = "E-Mail leer";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Ungültiges Format";
    } else if (str_contains($_POST["email"], "rcpt.at") || str_contains($_POST["email"], "damnthespam.at") || str_contains($_POST["email"], "wegwerfmail.de") || str_contains($_POST["email"], "trashmail.")) {
        $emailErr = "Ungültige Adresse";
    }
    if (empty($_POST["datenschutz"])) {
        $datenschutzErr = "Datenschutzhinweis muss gelesen und akzeptiert werden";
    }
}
?>
<!DOCTYPE html>
<!--
- Praktikum DBWT. Autoren:
- Luis, Scholten, 3518159
- Jonathan, Plum, 3524464
-->
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Newsletter</title>
</head>
<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <fieldset>
        <legend>Anmeldung</legend>
        <label>Anrede</label>
        <br>
        <input <?php if($gender == "frau") echo "checked";?> value="frau" type="radio" id="FrauID" name="GenderID">
        <label for="FrauID">Frau</label>
        <br>
        <input <?php if($gender == "mann") echo "checked";?> value="mann" type="radio" id="MannID" name="GenderID">
        <label for="MannID">Mann</label>
        <br>
        <br>
        <label for="firstnameID"> Vorname*</label><br>
        <input value="<?php echo $vorname ?>" name="vorname" type="text" size="34" placeholder="Bitte geben Sie Ihren Vornamen ein" id="firstnameID">
        <br>
        <label for="lastnameID"> Nachname*</label><br>
        <input value="<?php echo $nachname ?>" name="nachname" type="text" size="34" placeholder="Bitte geben Sie Ihren Nachnamen ein" id="lastnameID">
        <br>
        <label for="MailID"> Email*</label><br>
        <input value="<?php echo $email ?>" name="email" type="text" size="34" placeholder="Bitte geben Sie Ihre E-Mail ein" id="MailID">
        <br>
        <br>
        <label for="MenuID"> Benachrichtigungsintervall*</label><br>
        <select value="<?php echo $intervall ?>" id="MenuID" name="intervall">
            <option value="Tag">Tag</option>
            <option value="Woche">Woche</option>
            <option value="Monat">Monat</option>
        </select>
        <br>
        <br>
        <input <?php if($datenschutz == "on") echo "checked";?> name="datenschutz" type="checkbox" id="datenschutzID">
        <label for="datenschutzID">Datenschutzhinweise gelesen?</label>
        <br>
        <br>
        <input type="submit" value="Abschicken">
        <br>
        <p>*) Eingaben sind Pflicht</p>

    </fieldset>
</form>
<p><?php echo $emailErr;?><br>
    <?php echo $datenschutzErr;?><br>
    <?php echo $vornameErr;?><br>
    <?php echo $nachnameErr;?>
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $vornameErr == "" && $datenschutzErr == "" && $nachnameErr == "" && $emailErr == "") {
        echo "Die Anmeldung war erfolgreich. <br>";
        $myfile = fopen("formoutput.txt", "a");
        fwrite($myfile, "anrede,". $gender.PHP_EOL);
        fwrite($myfile, "vorname,". $vorname.PHP_EOL);
        fwrite($myfile, "nachname,". $nachname.PHP_EOL);
        fwrite($myfile, "email,". $email.PHP_EOL);
        fwrite($myfile, "intervall,". $intervall.PHP_EOL);
        fclose($myfile);
    }
    ?></p>
</body>

</html>