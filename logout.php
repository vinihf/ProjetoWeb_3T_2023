<?php
    session_start();
    unset($_SESSION['id']);
    unset($_SESSION['tipo']);
    header("location: login.php");
?>