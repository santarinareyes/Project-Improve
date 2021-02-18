<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php

function a() {
    $b = [
        "It is certain.",
        "It is decidedly so.",
        "Without a doubt.",
        "Yes - definitely.",
        "You may rely on it.",
        "As I see it, yes.",
        "Most likely.",
        "Outlook good.",
        "Yes.",
        "Signs point to yes.",
        "Reply hazy, try again.",
        "Ask again later.",
        "Better not tell you now.",
        "Cannot predict now.",
        "Concentrate and ask again.",
        "Don't count on it.",
        "My reply is no.",
        "My sources say no.",
        "Outlook not so good.",
        "Very doubtful"
        ];

        shuffle($b);

        foreach ($b as $c) {
        }

        echo $c;
}


if (isset($_POST["ask"])) {
    $q = $_POST["q"];
    if (!$q) {
        echo "ASK PLZ";
    } else {
        a();
    }
} else {
    echo "ASK PLZ";

}


?>


<form action="" method="post">
<input type="text" name="q">
<input type="submit" name="ask" value="ASK">
</form>

</body>
</html>