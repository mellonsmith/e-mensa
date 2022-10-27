<?php

$file = fopen('./accesslog.txt', 'a');

if(!$file){
    die('Öffnen fehlgeschlagen');
}

fwrite($file,  'Webbrowser:'.$_SERVER['HTTP_USER_AGENT'] . PHP_EOL. 'IP-Adresse:'. $_SERVER['SERVER_ADDR'].
    PHP_EOL . 'Datum und Uhrzeit:' .date('d-m-y h:i:s').PHP_EOL.PHP_EOL);

