<?php

$link = mysqli_connect(
"localhost", // Host der Datenbank
"root", // Benutzername zur Anmeldung
"123", // Passwort zur Anmeldung
"emensawerbeseite", // Auswahl der Datenbank
); // Optional: Port der Datenbank,
// falls nicht 3306 verwendet wird
if (!$link) {
    echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
    exit();
}

//echo mysqli_error($link);
//echo mysqli_errno($link);

$sql = "SELECT erfasst_am, name FROM gericht ORDER BY name DESC";

$result = mysqli_query($link, $sql);

echo "<table>" . "
<tr>
    <th>erfasst_am</th>
    <th>name</th>
</tr>";

while($row = mysqli_fetch_row($result)){
    echo '<tr>
            <td>'.$row[0]. '<br> </td>
            <td>'.$row[1]. '</td>';
    echo '</tr>';

}
