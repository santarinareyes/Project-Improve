<?php
session_start();
$_SESSION['sessionValue'] = "This is the value of the session <br/>";

if (isset($_SESSION)) {
    // print_r ($_SESSION);
    echo $_SESSION['sessionValue'];
}

if(isset($_GET["callthis"])) {
    echo $_GET["callthis"];
    $cookieName = "theCookie";
    $value = "insideTest.php";
    $expire = time() + (60*60*24*7);
    setcookie($cookieName, $value, $expire);
}

if (isset($_COOKIE[$cookieName])) {
    echo "<br/> $value <br/>";
}


// $_SESSION($cookieName) = "The Value";

?>