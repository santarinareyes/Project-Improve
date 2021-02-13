<?php
    include('includes/sql.php');



    $delete = "DELETE FROM blog WHERE id={$_GET['delete']}";
?>