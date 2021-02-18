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


function guessNumber($guessed) {
    global $play_count, $correct_guesses, $guess_low, $guess_high, $correct, $low, $high;
    $randNum = rand(1, 10);
    if ($guessed > 0) {
        $myGuess = $_POST['theguess'];
        $new_count = intval($_POST['count']);
        $new_count++;
        $play_count = $new_count;
        if ($guessed == $randNum) {
            $correct++;
            newValues();
        } else if ($guessed < $randNum) {
            $low++;
            newValues();
        } else if ($guessed > $randNum) {
            $high++;
            newValues();
        }
        echo "
        Random number: $randNum <br/>
        My guess: $myGuess <br/> <br/> 
        Statistics:<br/> 
        Correct guesses: $correct_guesses <br/> 
        Low guesses: $guess_low <br/> 
        High guesses: $guess_high
        ";
    }
}

function newValues() {
    global $guess_high, $guess_low, $correct_guesses, $correct, $low, $high;
    $high+0;
    $correct+0;
    $low+0;
    $guess_high = $high;
    $guess_low = $low;
    $correct_guesses = $correct;
}

if (isset($_POST['btnGuess'])) {
    $correct = intval($_POST['correct']);
    $low = intval($_POST['guess_low']);
    $high = intval($_POST['guess_high']);
    $guessed = intval($_POST["theguess"]);
    guessNumber($guessed);
} else {
    echo "Guess a number";
    $correct_guesses = 0;
    $guess_high = 0;
    $guess_low = 0;
    $play_count = 0;
}


?>
<form action="" method="post">
<input type="hidden" name="count" value="<?php echo $play_count; ?>">
<input type="hidden" name="correct" value="<?php echo $correct_guesses; ?>">
<input type="hidden" name="guess_high" value="<?php echo $guess_high; ?>">
<input type="hidden" name="guess_low" value="<?php echo $guess_low; ?>">
<input type="number" name="theguess" min="1" max="10" value="<?php echo rand(1, 10); ?>">
<input type="submit" name="btnGuess" value="Guess">
</form>
</body>
</html>