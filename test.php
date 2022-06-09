<?php

$url = "http://ww.localhost/metropolis/metropolis/index.php";

$verif = preg_match('/^(http|https):\/\/(www).([A-Z0-9][A-Z0-9_-]*(?:.[A-Z0-9][A-Z0-9_-]*)+):?(d+)?\/?/i', $url);

echo $verif;

if ($verif) {
    echo "URL ok";
} else {
    echo "URL faux";
}