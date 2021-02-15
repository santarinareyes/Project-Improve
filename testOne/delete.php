<?php
    include('includes/sql.php');


if (isset($_POST['delete'])) {
    global $delete;
    $query = "DELETE FROM blog WHERE id = $delete";
    $delete = $_POST['delete'];
    }
?>