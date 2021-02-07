<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form method="POST" action="nimStarted.php?a=started">
    <label for="player">Choose a player:</label><br/>
    <input type="radio" name="player[]" value="1">Player One</br>
    <input type="radio" name="player[]" value="2">Player Two</br><br/>
    <label for="sticks">How many sticks? (1 - 3 please)</label><br/>
    <input type="radio" name="sticks[]" value="1 stick">Player One</br>
    <input type="radio" name="sticks[]" value="2 sticks">Player One</br>
    <input type="radio" name="sticks[]" value="3 sticks">Player Two</br><br/>
    <!-- <input type="radio" name="sticks" value="stick_one">One stick</br>
    <input type="radio" name="sticks" value="stick_two">Two sticks</br>
    <input type="radio" name="sticks" value="stick_three">Three sticks</br><br/> -->
    <input type="submit" value ="Take sticks"/>
    </form>

    <div>
    <h1>Sticks left:</h1>
    </div>

</body>
</html>