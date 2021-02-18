<?php include "includes/arrays.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    


<a href="cookiessessiontest.php?callthis=theparameter">Cookies and Session Test</a></br>

<?php 
foreach ($theFiles as $practice) {
    $title = $practice['title'];
    $path = $practice['path'];    
?>

<a href="<?php echo $path; ?>"><?php echo $title; ?></a></br>

<?php 
} 
?>
</body>
</html>