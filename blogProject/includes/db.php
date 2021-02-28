<?php

$a = "mysql:host=localhost:8888;dbname=blogproject";
$b = "username";
$c = "password";

$abc = new PDO($a, $b, $c);

$abc->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$abc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

session_start();
ob_start();

