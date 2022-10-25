<!--
- Praktikum DBWT. Autoren:
- Luis, Scholten, 3518159
- Jonathan, Plum, 3524464
-->

<?php
/**
 * Praktikum DBWT. Autoren:
 * Luis, Scholten, 3518159
 * Jonathan, Plum, 3524464
 */
const GET_PARAM_MIN_STARS = 'search_min_stars';
const GET_PARAM_SEARCH_TEXT = 'search_text';
const GET_PARAM_SHOW_DESCRIPTION = 'show_description';
const GET_PARAM_LANGUAGE = 'get_language';
const GET_PARAM_RATING = 'get_rating';


$_GET['get_language'] = $_GET['get_language'] ?? "de";
$_GET['show_description'] = $_GET['show_description'] ?? 1;
$_GET['get_rating'] = $_GET['get_rating'] ?? '';

function calcMaxStars(array $ratings) : int {
   $maxStars = 0;
    foreach ($ratings as $rating) {
        if($rating['stars'] > $maxStars){
            $maxStars = $rating['stars'];
        }
    }
    return $maxStars;
}
function calcMinStars(array $ratings) : int {
    $minStars = 5;
    foreach ($ratings as $rating) {
        if($rating['stars'] < $minStars){
            $minStars = $rating['stars'];
        }
    }
    return $minStars;
}

$de = array (
        "Gericht" => "Gericht: ",
        "Allergene" => "Allergene: ",
        "Bewertungen" => "Bewertungen (Insgesamt: ",
        "Text" => "Text",
        "Autor" => "Autor",
        "Sterne" => "Sterne"
);
$en = array (
    "Gericht" => "meal: ",
    "Allergene" => "allergens: ",
    "Bewertungen" => "Ratings (overall: ",
    "Text" => "text",
    "Autor" => "author",
    "Sterne" => "stars"
);


if ($_GET['get_language'] == "en") {
    $language = $en;
    } else{
    $language = $de;
}

/**
 * List of all allergens.
 */
$allergens = [
    11 => 'Gluten',
    12 => 'Krebstiere',
    13 => 'Eier',
    14 => 'Fisch',
    17 => 'Milch'
];

$meal = [
    'name' => 'Süßkartoffeltaschen mit Frischkäse und Kräutern gefüllt',
    'description' => 'Die Süßkartoffeln werden vorsichtig aufgeschnitten und der Frischkäse eingefüllt.',
    'price_intern' => 2.90,
    'price_extern' => 3.90,
    'allergens' => [11, 13],
    'amount' => 42             // Number of available meals
];

$ratings = [
    [   'text' => 'Die Kartoffel ist einfach klasse. Nur die Fischstäbchen schmecken nach Käse. ',
        'author' => 'Ute U.',
        'stars' => 2 ],
    [   'text' => 'Sehr gut. Immer wieder gerne',
        'author' => 'Gustav G.',
        'stars' => 4 ],
    [   'text' => 'Der Klassiker für den Wochenstart. Frisch wie immer',
        'author' => 'Renate R.',
        'stars' => 4 ],
    [   'text' => 'Kartoffel ist gut. Das Grüne ist mir suspekt.',
        'author' => 'Marta M.',
        'stars' => 3 ]
];


$maxRating = calcMaxStars($ratings);
$minRating = calcMinStars($ratings);
$showRatings = [];



if (!empty($_GET[GET_PARAM_SEARCH_TEXT])) {
    $searchTerm = $_GET[GET_PARAM_SEARCH_TEXT];
    foreach ($ratings as $rating) {
        if (str_contains(strtolower($rating['text']), strtolower($searchTerm)) !== false) {
            $showRatings[] = $rating;
        }
    }
} else if (!empty($_GET[GET_PARAM_MIN_STARS])) {
    $minStars = $_GET[GET_PARAM_MIN_STARS];
    foreach ($ratings as $rating) {
        if ($rating['stars'] >= $minStars) {
            $showRatings[] = $rating;
        }
    }
} else if (!empty($_GET['get_rating'])) {
    $stars = 3;
    if($_GET['get_rating'] == 'top') {
        $stars = calcMaxStars($ratings);
    } elseif ($_GET['get_rating'] == 'flop'){
        $stars = calcMinStars($ratings);
    }
    foreach ($ratings as $rating) {
        if ($rating['stars'] == $stars) {
            $showRatings[] = $rating;
        }
    }
} else {
    $showRatings = $ratings;
}

function calcMeanStars(array $ratings) : float {
    $sum = 0;
    foreach ($ratings as $rating) {
        $sum += $rating['stars'] / count($ratings);
    }
    return $sum;
}

?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8"/>
        <title><?php
            echo $language["Gericht"];
            echo $meal['name']; ?></title>
        <style>
            * {
                font-family: Arial, serif;
            }
            .rating {
                color: darkgray;
            }
        </style>
    </head>
    <body>
    <?php
        echo $minRating;
    ?>
        <h1><?php echo $meal['name']; ?></h1>
        <p><?php
            if ($_GET['show_description'] != 0) {
                echo $meal['description'];} ?></p>
        <p> <?php
            echo $language['Allergene'];
            ?> </p>
        <ul><?php
        foreach ($meal['allergens'] as $ag) {
            echo "<li>{$allergens[$ag]}</li>
                  ";
        }
            ?></ul>
        <p>
            Preis intern:
            <?php
            echo number_format($meal['price_intern'], 2)."€";
            ?>
            <br>
            <br>
            Preis extern:
            <?php
            echo number_format($meal['price_extern'], 2)."€";
            ?>
        </p>
        <h1><?php
            echo $language["Bewertungen"];
            echo calcMeanStars($ratings); ?>)</h1>
        <form method="get">
            <label for="search_text">Filter:</label>
            <input id="search_text" type="text" name="search_text" value="<?php echo $_GET['search_text'] ?? '' ?>" >
            <input type="submit" value="Suchen">

        </form>
        <table class="rating">
            <thead>
            <tr>
                <td><?php
                    echo $language["Text"];
                    ?> </td>
                <td><?php
                    echo $language["Autor"];
                    ?></td>
                <td><?php
                    echo $language["Sterne"];
                    ?></td>

            </tr>
            </thead>
            <tbody>
            <?php
        foreach ($showRatings as $rating) {
            echo "<tr><td class='rating_text'>{$rating['text']}</td>
                      <td class='rating_text'>{$rating['author']}</td>
                      <td class='rating_stars'>{$rating['stars']}</td>
                  
                  </tr>";
        }
        ?>
            </tbody>
        </table>
    </body>
</html>