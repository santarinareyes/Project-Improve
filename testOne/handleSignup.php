<?php 
    include("includes/sql.php");

$username = $_POST['username'];
$password = $_POST['password'];
$sql = "INSERT INTO users(username, password) VALUES(:username_IN, :password_IN)";
$stm = $pdo->prepare($sql);
$stm->bindParam(':username_IN',$username);
$stm->bindParam(':password_IN',$password);

if($stm->execute()) {
    header("location:account.php");
} else {
    echo "Det gick fel!";
}

?>