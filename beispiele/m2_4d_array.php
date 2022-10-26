<?php
$famousMeals = [
    1 => ['name' => 'Currywurst mit Pommes',
        'winner' => [2001, 2003, 2007, 2010, 2020]],
    2 => ['name' => 'Hähnchencrossies mit Paprikareis',
        'winner' => [2002, 2004, 2008]],
    3 => ['name' => 'Spaghetti Bolognese',
        'winner' => [2011, 2012, 2017]],
    4 => ['name' => 'Jägerschnitzel mit Pommes',
        'winner' => 2019]
];

function noWins($fm) : void
{
    $wins = array();
    for ($i = 2000; $i <= 2022; $i++) {
        $wins[$i] = 0;
    }

    foreach ( $fm as $famousMeal) {
        if (!is_array($famousMeal['winner'])) {
            $wins[$famousMeal['winner']] = 1;

        } else {

            for ($i = (sizeof($famousMeal['winner']) - 1); $i >= 0; $i--) {
                $wins[$famousMeal['winner'][$i]] = 1;
            }
        }


    }
    for ($i = 2000; $i <= 2022; $i++) {
        if ($wins[$i] != 1) {
            echo $i . ', ';
        }
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
    <title>Addierer</title>
</head>
<body>
    <ol>
        <?php
            foreach ($famousMeals as $famousMeal){
                echo '<li>'.$famousMeal['name'].'</li>';

                if(!is_array($famousMeal['winner'])){
                    echo $famousMeal['winner'];

                } else {

                    for ($i = (sizeof($famousMeal['winner']) - 1); $i >= 0; $i--){
                        echo $famousMeal['winner'][$i];
                        if ($i != 0) echo ', ';
                    }
                }
                echo '<br><br>';
            }
            nowins($famousMeals);
        ?>
    </ol>
</body>

</html>

