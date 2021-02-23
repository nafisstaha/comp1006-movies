<!DOCTYPE html>
<html lang="en">

    <!--head-->
    <head>
        <meta charset="UTF-8">
        <title>Saving Director...</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    </head>

    <!--body-->
    <body>

        <?php

            //store entered form's values
            $directorName = $_POST['directorName'];

            //a variable for checking the input validation
            $canSave = true;

            //inputs' validation for saving data
            if (empty(trim($directorName))) {
                echo 'Name is required<br />';
                $canSave = false;
            }

        //add data to database after validation
        if ($canSave == true) {

            //connect to AWS db
            $db = new PDO('mysql:host=172.31.22.43;dbname=Nafiseh200470752', 'Nafiseh200470752', 'bDjeeJHyam');

            //set up sql insert command
            $sql = "INSERT INTO directors (directorName) VALUES (:directorName)";

            //fill insert parameters with new variables
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':directorName', $directorName, PDO::PARAM_STR, 50);

            //execute
            $cmd->execute();

            //disconnect db
            $db = null;

            echo 'Director Saved';
        }

        ?>

    </body>
</html>