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
<?php
$vornameErr = $nachnameErr = $emailErr = $datenschutzErr = "";
$vorname = $_POST["vorname"];
$nachname = $_POST["nachname"];
$email = $_POST["email"];
$datenschutz = $_POST["datenschutz"];


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
} else if (str_contains($_POST["email"], "rcpt.at") || str_contains($_POST["email"], "damnthespam.at") || str_contains($_POST["email"], "wegwerfmail.de") || str_contains($_POST["email"], "trashmail")) {
    $emailErr = "Ungültige Adresse";
}
if (empty($_POST["datenschutz"])) {
    $datenschutzErr = "Datenschutzhinweis muss gelesen und akzeptiert werden";
}
?>

<p><?php echo $emailErr;?><br>
    <?php echo $datenschutzErr;?><br>
    <?php echo $vornameErr;?><br>
   <?php echo $nachnameErr;?>
<?php if ($vornameErr == "" && $datenschutzErr == "" && $nachnameErr == "" && $emailErr == "") {
    echo "VALIDIERT <br>";
}
?></p>

</body>
</html>