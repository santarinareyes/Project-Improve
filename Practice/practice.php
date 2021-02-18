<?php

if (isset($_POST["submit"])) {
    $first = $_POST['firstname'];
    $last = $_POST['lastname'];
    
    $db = "INSERT INTO test (Firstname, Lastname) VALUES ('$first', '$last')";
    $stm = $pdo->prepare($db);
    if ($stm->execute()) {
        echo "Postad";
    } else {
        echo "Error";
    }
}
    ?>

<form action="" method="post">
<input type="text" name="firstname">
<input type="text" name="lastname">
<input type="submit" name="submit" value="INSERT DATA">
</form>