<?php

if ($_GET['a'] == 'started') {
    $player = $_POST['player'];
    for($i = 0; $i < count($player); $i++) {
            echo "Player " . $player[$i] . " took ";
        }
    }

if ($_GET['a'] == 'started') {
    $sticks = $_POST['sticks'];
    for($i = 0; $i < count($sticks); $i++) {
            echo $sticks[$i] . ".";
        }
    }
?>