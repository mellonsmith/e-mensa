<?php
include 'm2_4a_standardparameter.php';
const GET_PARAM_first = 'firstID';
const GET_PARAM_second = 'secondID';
$_GET['secondID'] = $_GET['secondID'] ?? 0;
$_GET['firstID'] = $_GET['firstID'] ?? 0;
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
    <title>Addierer</title>
</head>
<body>
<form method="get">
    <fieldset>
        <legend>Rechner</legend>
        <br>
        <label for="firstID"> Erste Zahl*</label><br>
        <input type="text" size="34" required="required" placeholder="Bitte geben Sie die erste Zahl an" id="firstID" name="firstID">
        <br>
        <label for="secondID"> Zweite Zahl*</label><br>
        <input type="text" size="34" required="required" placeholder="Bitte geben Sie die zweite Zahl an" id="secondID" name="secondID">
        <br>
        <input type="submit" value="Berechne">
        <br>
    </fieldset>
</form>
<h1>Ergebnis: <?php echo addieren($_GET['firstID'],$_GET['secondID']); ?></h1>
</body>

</html>