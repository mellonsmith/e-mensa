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

?>

<p><?php echo $emailErr;?><br>
    <?php echo $datenschutzErr;?><br>
    <?php echo $datenschutz;?><br>
    <?php echo $vornameErr;?><br>
   <?php echo $nachnameErr;?>
<?php if ($vornameErr == "" && $datenschutzErr == "" && $nachnameErr == "" && $emailErr == "") {
    echo "VALIDIERT <br>";
    $myfile = fopen("formoutput.txt", "a");
    fwrite($myfile, "vorname,". $vorname.PHP_EOL);
    fwrite($myfile, "nachname,". $nachname.PHP_EOL);
    fwrite($myfile, "email,". $email.PHP_EOL);
    fwrite($myfile, "intervall,". $intervall.PHP_EOL);
    fclose($myfile);
}
?></p>

</body>
</html>