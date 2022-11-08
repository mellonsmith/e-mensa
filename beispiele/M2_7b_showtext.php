<?php
const GET_PARAM_SEARCH_TEXT = 'search_text';

$file = fopen('./en.txt', 'r');

$result = '';

if(!empty($_GET[GET_PARAM_SEARCH_TEXT])){
    if($file){
        $searchTerm = $_GET[GET_PARAM_SEARCH_TEXT];
        while (($line = fgets($file)) !== false) {
            $wordArray = explode(';', $line);
            $germanWord = $wordArray[0];
            $englishWord = $wordArray[1];

            $englishWord = trim($englishWord);;
            if (strtolower($englishWord) == strtolower($searchTerm)) {
                $result = $germanWord;

            } elseif (strtolower($germanWord) == strtolower($searchTerm)){
                $result = $englishWord;

            }

            /*if (str_contains(strtolower($germanWord), strtolower($searchTerm)) !== false) {
                $result = $englishWord;
            } elseif (str_contains(strtolower($englishWord), strtolower($searchTerm)) !== false){
                $result = $germanWord;
            }*/
        }
    }
}



/*if (!empty($_GET[GET_PARAM_SEARCH_TEXT])) {

    foreach ($file as $line) {

    }
}*/




?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8"/>
        <title>Übersetzer</title>
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
<form method="get">
    <label for="search_text">Filter:</label>
    <input id="search_text" type="text" name="search_text" value="<?php echo $_GET['search_text'] ?? '' ?>" >
    <input type="submit" value="Suchen">
    <?php
    if($result == ''){
        echo 'Das gesuchte Wort ' . $result . 'ist nicht enthalten';
    } else {
        echo $result;
    }
    ?>
</form>
</body>