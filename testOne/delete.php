<?php
    include('includes/sql.php');

    if (isset($_POST['btndelete'])) {
        $delete = $_POST['delete'];
        $stm = $pdo->query("DELETE FROM blog WHERE id = $delete");
        header("location:feedbacks.php");
    }
?>