<?php
include("includes/sql.php");
?>

<?php
$currentUsername = $_POST['username'];
$currentPassword = $_POST['password'];


$stm = $pdo->query("SELECT id, username, password FROM users");

if (isset($_POST['submit'])) {
    foreach ($stm as $value) {
        while ($currentUsername == $value['username']) {
            echo $value['username'];
            break;
        }
    }
}

// foreach ($stm as $value) {
//     if ($value['username'] == $currentUsername && $value['password'] == $currentPassword) {
//         echo $value['username'] . " " . $value['password'];
//     } else if ($value['username'] == $currentUsername && $value['password'] != $currentPassword) {
//         echo "<p>Wrong password!</p>";
//     } else if ($value['username'] != $currentUsername) {
//         echo "Username does not exist!";
//     }
// }
// foreach ($stm as $value) {

// om databen har samma text som $currentUsername > continue
// if ($value['username'] == $currentUsername) {
//     continue;
// } else if ($value['username'] == $currentUsername && $value['password'] != $currentPassword) {
//     echo "<p>Wrong password!</p>";
// } else if ($value['username'] == $currentUsername && $value['password'] == $currentPassword) {
//     echo $value['username'] . " " . $value['password'];
// } else {
//     echo "Username does not exist!";
//     break;
// }

// if ($value['username'] != $currentUsername) {
//     echo "testaaa";
//     break;
// } else if ($value['username'] == $currentUsername) {
//     echo $currentUsername;
// }
// }

?>

<p>Welcome!</p>