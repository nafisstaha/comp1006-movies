<?php

    $title = "Registering...";
    include 'header.php';

    //store entered form's values
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    //a variable for checking the input validation
    $canSave = true;

    //inputs' validation for saving data

    //username
    if (empty($username)) {
        echo 'Username required<br />';
        $canSave = false;
    }

    //password
    if (empty($password)) {
        echo 'Password required<br />';
        $canSave = false;
    }

    //confirm password
    if ($password != $confirm) {
        echo 'Passwords must match<br />';
        $canSave = false;
    }

    //add data to database after validation
    if ($canSave) {

        // connect
        include 'db.php';

        //set up sql insert command
        $sql = "SELECT * FROM users WHERE username = :username";

        //fill insert parameters with new variables
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);

        //execute
        $cmd->execute();

        $user = $cmd->fetch();

        //existing user alert
        if (!empty($user)) {
            echo '<h5 class="alert alert-danger">User already exists</h5>';
            $db = null;
            exit(); // stop processing more code
        }

        //set up sql insert command
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";

        //hash password
        $password = password_hash($password, PASSWORD_DEFAULT);

        //fill insert parameters with new variables
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
        $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);

        //execute
        $cmd->execute();

        //disconnect db
        $db = null;

        //redirect to login
        header('location:login.php');
    }

?>

</body>
</html>