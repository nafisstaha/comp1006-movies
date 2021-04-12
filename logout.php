<?php
    //start the session
    session_start();

    //remove sessions
    session_unset();

    //end the session
    session_destroy();

    //redirect to login
    header('location:login.php');
?>