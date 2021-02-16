<?php

// Delete selected "feedback" from the database
function deleteBlog()
{
    global $pdo;
    if (isset($_POST['btndelete'])) {
        $delete = ($_POST['btndelete']);
        $onlyid = substr($delete, 7);
        $stm = $pdo->query("DELETE FROM blog WHERE id = $onlyid");
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
