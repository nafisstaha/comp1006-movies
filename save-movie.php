<!DOCTYPE html>
<html lang="en">

    <!--head-->
    <head>
        <meta charset="UTF-8">
        <title>Saving Movie Details...</title>
    </head>

    <!--body-->
    <body>

        <?php

            //store entered form's values
            $movieName = $_POST['movieName'];
            $releaseYear = $_POST['releaseYear'];
            $imdb = $_POST['imdb'];
            $directorName = $_POST['directorName'];

            //a variable for checking the input validation
            $canSave = true;

            //inputs' validation for saving data
            if (empty(trim($movieName))) {
                echo 'Name is required<br />';
                $canSave = false;
            }

            //checking validation for select parameter
            if ($releaseYear['value'] === '') {
                echo 'Release Year is required<br />';
                $canSave = false;
            }

            //checking validation for imdb to be between 1 and 10
            if ($imdb < 1 || $imdb >10) {
                echo 'IMDB is incorrect<br />';
                $canSave = false;
            }

            if (empty(trim($directorName))) {
                echo 'Director is required<br />';
                $canSave = false;
            }

            if ($canSave == true) {

                //connect to AWS db
                $db = new PDO('mysql:host=172.31.22.43;dbname=Nafiseh200470752', 'Nafiseh200470752', 'bDjeeJHyam');

                //set up sql insert command
                $sql = "INSERT INTO movies (movieName, releaseYear, imdb, directorName) VALUES (:movieName, :releaseYear, :imdb, :directorName)";

                //fill insert parameters with new variables
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':movieName', $movieName, PDO::PARAM_STR, 100);
                $cmd->bindParam(':releaseYear', $releaseYear, PDO::PARAM_INT);
                $cmd->bindParam(':imdb', $imdb, PDO::PARAM_STR, 10);
                $cmd->bindParam(':directorName', $directorName, PDO::PARAM_INT, 50);

                //execute
                $cmd->execute();

                //disconnect db
                $db = null;

                echo "Movie Saved";
            }
        ?>

    </body>
</html>