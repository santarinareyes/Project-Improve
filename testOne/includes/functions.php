<?php

// Delete selected "feedback" from the database
function deleteBlog()
{
    global $pdo;
    if (isset($_POST['btndelete'])) {
        $delete = ($_POST['btndelete']);
        $onlyid = substr($delete, 7);
        $pdo->query("DELETE FROM blog WHERE id = $onlyid");
        header("location:feedbacks.php#anchorTest");
    }
}

//Add submitted feedback to the database
function addBlog()
{
    global $pdo;
    $name = $_POST["name"];
    $message = $_POST["message"];

    if (isset($_POST['submit'])) {
        $sql = "INSERT INTO blog (Name, Message) VALUES(:Name_IN, :Message_IN)";
        $stm = $pdo->prepare($sql);
        $stm->bindParam(":Name_IN", $name);
        $stm->bindParam(":Message_IN", $message);

        if ($stm->execute()) {
            echo "Postad";
            header("location:feedbacks.php#anchorTest");
        } else {
            echo "Error";
        }
    };
}

// Register-info to the database
function registerAcc()
{
    global $pdo;
    $username = $_POST['usernamesign'];
    $password = $_POST['passwordsign'];
    $sql = "INSERT INTO users(username, password) VALUES(:username_IN, :password_IN)";
    $stm = $pdo->prepare($sql);
    $stm->bindParam(':username_IN', $username);
    $stm->bindParam(':password_IN', $password);

    if ($stm->execute()) {
        header("location:account.php");
    } else {
        echo "Det gick fel!";
    }
}
