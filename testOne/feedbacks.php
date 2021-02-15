<?php
define("TITLE", "Feedbacks | Jus For Fun");
include("includes/header.php");
include("includes/sql.php");

$stm = $pdo->query("SELECT id, name, message FROM blog");
// print_r($stm->fetch())
while ($post = $stm->fetch()) {

?>
<p><?php echo $post['name'] . " " . $post['message'];?></p> 
<form action="delete.php" method="post">
<input type="submit" name="delete" value="<?php echo $post['id']; ?>">
</form>
<?php } ?>
<form action="blogsubmitted.php" method="post">
<input type="text" name="name" placeholder="Name">
<input type="text" name="message" placeholder="Message">
<input type="submit" value="Post">
</form>

<?php
include("includes/footer.php")
?>
