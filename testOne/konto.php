<pre>
<?php 


    include("includes/sql.php");

    $curentUsername = $_POST['username'];
    $curentPassword = $_POST['password']; 


    $stm = $pdo->query("SELECT id, username, password FROM users");
    while ($row = $stm->fetch()) {

        if ($curentUsername == $row['username']){
            echo $row['id'] . " " . $row['username'] . " " . $row['password'] . "<br />";
            break;
        }
    }
    
    

?>
</a>
Welcome!