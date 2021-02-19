<?php

$a = "mysql:host=localhost:8888;dbname=blogproject";
$b = "username";
$c = "password";

$abc = new PDO($a, $b, $c);

    if($abc) {
        echo "connected";
    } else {
        echo "nope";
    }