<?php
define ("TITLE", "Encrypt Testing");
include "includes/header.php";
?>

<?php
$someText = "Tiger";
echo "Orignal word: $someText <br/>";

$first = "$2y$10$";
$second = "somethingwith22symbols";
$third = $first . $second;

$after = crypt($someText, $third);
echo "After encrypting: $after <br/>";

?>
<?php include "includes/footer.php" ?>