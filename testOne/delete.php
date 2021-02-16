<?php
    include('includes/sql.php');

    if (isset($_POST['btndelete'])) {
        $delete = ($_POST['btndelete']);
        $onlyid = substr($delete, 7);
        $stm = $pdo->query("DELETE FROM blog WHERE id = $onlyid");
        header("location:feedbacks.php");
    }
?>