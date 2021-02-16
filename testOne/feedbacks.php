<?php
define("TITLE", "Feedbacks | Jus For Fun");
include("includes/header.php");
include("includes/sql.php");
?>

<?php 
$stmt = $pdo->query("SELECT id FROM blog");

if ($stmt->fetch()) {
?>
<form action="delete.php" method="post">
<?php 
$stm = $pdo->query("SELECT id, name, message FROM blog");
// print_r($stm->fetch())
while ($post = $stm->fetch()) {
    echo "<p> $post[name] <br/> $post[message] <br/> (ID: $post[id])</p> <input type=\"hidden\" name=\"delete\" value=\"$post[id]\">
<input type=\"submit\" name=\"btndelete\" value=\"DELETE POSTID: $post[id]\">"
    ?>
</form>
<?php }
} else {
    echo "No feedbacks yet"; }?>

<form action="blogsubmitted.php" method="post">
<input type="text" name="name" placeholder="Name">
<input type="text" name="message" placeholder="Message">
<input type="submit" name="submit" value="Send Feedback">
</form>

<?php
include("includes/footer.php")
?>
