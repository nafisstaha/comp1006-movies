<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Saving Movie Details...</title>
    </head>
    <body>
        <?php
            // store the values entered in the form in variables
            $name = $_POST['name'];
            $releaseYear = $_POST['releaseYear'];
            $imdb = $_POST['imdb'];
            $director = $_POST['director'];
            // add variable to indicate if we should save or not
            $ok = true;

            // validate inputs before saving to ensure all data is valid
            if (empty(trim($name))) { // use trim to remove leading & trailing spaces
                echo 'Name is required<br />';
                $ok = false;
            }

            if ($releaseYear['value'] === '') {
                echo 'Release Year is required<br />';
                $ok = false;
            }

            if ($imdb < 1 || $imdb >10) {
                echo 'IMDB is incorrect<br />';
                $ok = false;
            }

            if (empty(trim($director))) {
                echo 'Director is required<br />';
                $ok = false;
            }

            if ($ok == true) {
                // connect to the db
                $db = new PDO('mysql:host=172.31.22.43;dbname=Nafiseh200470752', 'Nafiseh200470752', 'bDjeeJHyam');

                // set up the SQL INSERT command to add a new game.  : indicates a placeholder or paramter
                $sql = "INSERT INTO movies (name, releaseYear, imdb, director) VALUES 
                                    (:name, :releaseYear, :imdb, :director)";

                // fill the INSERT parameters with our variables
                // connect the db connection w/the SQL command
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':name', $name, PDO::PARAM_STR, 100);
                $cmd->bindParam(':releaseYear', $releaseYear, PDO::PARAM_INT);
                $cmd->bindParam(':imdb', $imdb, PDO::PARAM_STR, 10);
                $cmd->bindParam(':director', $director, PDO::PARAM_INT, 50);

                // execute the save
                $cmd->execute();

                // disconnect
                $db = null;

                echo "Movie Saved";
            }
        ?>
    </body>
</html>