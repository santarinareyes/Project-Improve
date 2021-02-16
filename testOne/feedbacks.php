<?php
define("TITLE", "Feedbacks | Jus For Fun");
include("includes/header.php");
include("includes/sql.php");
?>

<?php
$stmt = $pdo->query("SELECT id FROM blog");

if ($stmt->fetch()) {
?>
    <form action="delete.php" method="post" id="anchorTest">
    <?php
    $stm = $pdo->query("SELECT id, name, message FROM blog");
    // print_r($stm->fetch())
    while ($post = $stm->fetch()) {
        echo "<p>Name: $post[name] <br/>Message: <br/> $post[message] <br/> 
    <input type=\"submit\" name=\"btndelete\" value=\"DELETE $post[id]\">";
    }
} else {
    echo "No feedbacks yet";
} ?>
    </form>

    <form action="blogsubmitted.php" method="post">
        <input type="text" name="name" placeholder="Name">
        <input type="text" name="message" placeholder="Message">
        <input type="submit" name="submit" value="Send Feedback">
    </form>

    <?php
    include("includes/footer.php")
    ?>