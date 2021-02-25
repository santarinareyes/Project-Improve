<?php 
include "db.php";
session_start();

if(isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stm = $abc->prepare("SELECT * FROM users WHERE username = :name");
    $stm->bindParam(":name", $username);
    $stm->execute();

    while($rows = $stm->fetch()) {
        $user_id = $rows['user_id'];
        $db_username = $rows['username'];
        $db_password = $rows['user_password'];
        $user_firstname = $rows['user_firstname'];
        $user_lastname = $rows['user_lastname'];
        $user_role = $rows['user_role'];
    }

    if (password_verify($password, $db_password)) {
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $user_firstname;
        $_SESSION['lastname'] = $user_lastname;
        $_SESSION['role'] = $user_role;

        header("location:../admin");
    } else {
        header("location:../index.php");
    }
}

?>