<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
if($_SERVER['REQUEST_METHOD'] == "POST") {
    
    if (isset($_POST['clickies'])) {
        $count = intval($_POST['count']);
   $count++;
   $place = $count;
   $title = $count;
}

} else {
    $place = 0;
    
$title = 0;
}

  echo '<div class="boxes"><h1>Statistics Calculator: Version 1</h1></div>';

  $links = array('<div class="fancyBoxes"><a href="standardisedForm.php"><img class="mainPic" src="normalDist.svg" alt="a normal distribution, courtesy openclipart.org"></a></div>', "", "");

  echo $links[$place];

  echo $place; echo "<br/>";

  $subtitle = array('<div class="boxes"><h1>Standardised Score</h1></div>', '<div class="boxes"><h1>Standard Deviation</h1></div>', '<div class="boxes"><h1>Averages</h1></div>');

  echo $subtitle[$title];

?>
<form action="" method="POST">
<input type="submit" id="clickies" name="clickies" value="" />
<input type="hidden" id="count" name="count" value="<?php echo $place;?>" />   
</form>

     
</body>
</html>