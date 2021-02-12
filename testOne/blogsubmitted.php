<?php 

// databasen
include("includes/sql.php");

$name = $_POST["name"];
$message = $_POST["message"];

$sql ="INSERT INTO blog (Name, Message) VALUES(:Name_IN, :Message_IN)";
$stm = $pdo->prepare($sql);
$stm->bindParam(":Name_IN", $name);
$stm->bindParam(":Message_IN", $message);

if ($stm->execute()) {
    echo "Postad";
    header("location:feedbacks.php");
} else {
    echo "Error";
};
?>

