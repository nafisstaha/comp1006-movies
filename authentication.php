<?php

    //session_start if it didn't
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    //access check, show the image if the user is logged in
    if (empty($_SESSION['username'])) {
        header('location:login.php');
        exit();
    }

?>