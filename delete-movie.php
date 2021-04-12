<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Deleting Movie...</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    </head>

    <body>
        <?php

        //get the selected movieId from URL
        $movieId = $_GET['movieId'];

        if (is_numeric($movieId)) {

            try {
                //connect
                include 'database.php';
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //ERROR DB handler

                //SQL DELETE command
                $sql = "DELETE FROM movies WHERE movieId = :movieId";

                //run sql query
                $cmd = $db->prepare($sql);

                $cmd->bindParam(':movieId', $movieId, PDO::PARAM_INT);

                //execute
                $cmd->execute();

                //disconnect
                $db = null;
            }

            catch (exception $e) {
                //redirect to error page
                header('location:error.php');
                exit(); //stop code execution now
            }
        }

        //redirect to games page
        header('location:movies.php');
        ?>
    </body>
</html>