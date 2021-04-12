<?php

    //store entered form's values
    $username = $_POST['username'];
    $password = $_POST['password'];

    //connect to db
    include 'db.php';
    $sql = "SELECT * FROM users WHERE username = :username";

    //fill insert parameters with new variables
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);

    //execute
    $cmd->execute();
    $user = $cmd->fetch();

    //existing user
    if (!empty($user)) {

        //password validation
        if (password_verify($password, $user['password'])) {

            //valid
            session_start(); // accesses the current session
            $_SESSION['username'] = $username; // store identity in a session variable
            header('location:games.php');

        //invalid, redirect to login page
        } else {
            header('location:login.php?invalid=true');
        }
        
    //redirect to login page
    } else {
        header('location:login.php?invalid=true');
    }

?>
