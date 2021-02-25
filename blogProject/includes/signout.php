<?php   session_start();
        $_SESSION['username'] = null;
        $_SESSION['firstname'] = null;
        $_SESSION['lastname'] = null;
        $_SESSION['role'] = null;
        session_destroy();
        header("location:../index.php")
?>