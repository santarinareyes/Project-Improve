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
$sticks_array = [1, 2, 3, 4 ,5 ,6 ,7 ,8 ,9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21];
$sticks_left = array_pop($sticks_array);
$player = $_POST['player'];
$sticks = $_POST['sticks'];

// Function

// function new_array() {
//     global $sticks_array;
//     $testing = array_pop($sticks_array);
//     return $testing;
// }

// function new_sticks() {
//     global $sticks;
//     global $sticks_left;
//     if ($sticks_left == false) {
//         return 21;
//     } else if ($sticks_left < 22 && $sticks_left > 17) {
//         for($i = 0; $i < count($sticks); $i++) {
//         $sticks_left -= $sticks[$i];
//         return $sticks_left;
//         } 
//     } else if ($sticks_left < 19 && $sticks_left > 15) {
//         for($i = 0; $i < count($sticks); $i++) {
//         $sticks_left -= $sticks[$i];
//         return $sticks_left;
//         } 
//     }
    
// }

?>

<form method="POST" action="nimStarted.php?a=round5">
    <label for="player">Choose a player:</label><br/>
    <input type="radio" name="player[]" value="1" checked="checked">Player One</br>
    <input type="radio" name="player[]" value="2">Player Two</br><br/>
    <label for="sticks">How many sticks? (1 - 3 please)</label><br/>
    <input type="radio" name="sticks[]" value="1 stick" checked="checked">1 stick</br>
    <input type="radio" name="sticks[]" value="2 sticks">2 sticks</br>
    <input type="radio" name="sticks[]" value="3 sticks">3 sticks</br><br/>
    <!-- <input type="radio" name="sticks" value="stick_one">One stick</br>
    <input type="radio" name="sticks" value="stick_two">Two sticks</br>
    <input type="radio" name="sticks" value="stick_three">Three sticks</br><br/> -->
    <input type="submit" value ="Take sticks"/>
    </form>

    <div>
    <p>
    <?php   for($i = 0; $i < count($player); $i++) {
               echo "Player " . $player[$i] . " took ";
            } if ($sticks_left === "") {
                $sticks_left = $sticks_array[20];
            } else if ($sticks_left === 21) {
                for($i = 0; $i < count($sticks); $i++) {
                    echo $sticks[$i] . ".";
                        if ($sticks[$i] = 1) {
                            $sticks_left = $sticks_array[19];
                        } else if ($sticks[$i] = 2) {
                            $sticks_left = $sticks_array[18];
                        } else if ($sticks[$i] = 3) {
                            $sticks_left = $sticks_array[17];
                        }
                } 
            } else if ($sticks_left === 20) {
                for($i = 0; $i < count($sticks); $i++) {
                    echo $sticks[$i] . ".";
                        if ($sticks[$i] = 1) {
                            $sticks_left = $sticks_array[18];
                        } else if ($sticks[$i] = 2) {
                            $sticks_left = $sticks_array[17];
                        } else if ($sticks[$i] = 3) {
                            $sticks_left = $sticks_array[16];
                        }
                    }
            } 
    ?>
    </p>
    <h1>Sticks left:</h1>
    <p><?php echo $sticks_left?></p>
    </div>


</body>
</html>