<pre>
<?php


include("includes/sql.php");

$curentUsername = $_POST['username'];
$curentPassword = $_POST['password'];


$stm = $pdo->query("SELECT id, username, password FROM users");

if (isset($_POST['submit'])) {
    foreach ($stm as $value) {
        while ($curentUsername == $value['username']) {
            echo $value['username'];
            break;
        }
    }
}

// foreach ($stm as $value) {
//     if ($value['username'] == $curentUsername && $value['password'] == $curentPassword) {
//         echo $value['username'] . " " . $value['password'];
//     } else if ($value['username'] == $curentUsername && $value['password'] != $curentPassword) {
//         echo "<p>Wrong password!</p>";
//     } else if ($value['username'] != $curentUsername) {
//         echo "Username does not exist!";
//     }
// }
// foreach ($stm as $value) {

// om databen har samma text som $curentUsername > continue
// if ($value['username'] == $curentUsername) {
//     continue;
// } else if ($value['username'] == $curentUsername && $value['password'] != $curentPassword) {
//     echo "<p>Wrong password!</p>";
// } else if ($value['username'] == $curentUsername && $value['password'] == $curentPassword) {
//     echo $value['username'] . " " . $value['password'];
// } else {
//     echo "Username does not exist!";
//     break;
// }

// if ($value['username'] != $curentUsername) {
//     echo "testaaa";
//     break;
// } else if ($value['username'] == $curentUsername) {
//     echo $curentUsername;
// }
// }

?>

<p>Welcome!</p>