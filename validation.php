<?php

    //store entered form's values
    $username = $_POST['username'];
    $password = $_POST['password'];

    //connect to db
    include 'database.php';
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
            session_start();
            $_SESSION['username'] = $username;
            header('location:movies.php');

        //invalid, redirect to login page
        } else {
            header('location:login.php?invalid=true');
        }

    //redirect to login page
    } else {
        header('location:login.php?invalid=true');
    }

?>
