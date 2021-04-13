<!DOCTYPE html>
<html lang="en">

    <!--head-->
    <head>
        <meta charset="UTF-8">
        <title>Saving Movie Details...</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    </head>

    <!--body-->
    <body>

        <?php

            include 'authentication.php';

            //store entered form's values
            $movieName = $_POST['movieName'];
            $releaseYear = $_POST['releaseYear'];
            $imdb = $_POST['imdb'];
            $directorId = $_POST['directorId'];
            $movieId = $_POST['movieId'];

            //a variable for checking the input validation
            $canSave = true;

            //inputs' validation for saving data

            //movie's name
            if (empty(trim($movieName))) {
                echo 'Name is required<br />';
                $canSave = false;
            }

            //checking validation for select parameter
            if ($releaseYear['value'] === '') {
                echo 'Release Year is required<br />';
                $canSave = false;
            }

            //checking validation for imdb to be between 1 and 10 and being numeric
            if ($imdb<1 || $imdb>10) {
                echo 'IMDB is incorrect<br />';
                $canSave = false;
            }
            else {
                if (!is_numeric($imdb)) {
                echo 'IMDB must be numeric<br />';
                $canSave = false;
                }
            }

            //director's name
            if (empty($directorId)) {
                echo 'Director is required<br />';
                $canSave = false;
            }
            else {
                if (!is_numeric($directorId)) {
                    echo 'Director Id must be numeric<br />';
                    $canSave = false;
                }
            }

            //upload the image
            $image = null;

            if ($_FILES['image']['name'] != null) {
                $image = $_FILES['image']['name'];

                $tmp_name = $_FILES['image']['tmp_name'];

                $type = mime_content_type($tmp_name);

                if ($type != "image/png" && $type != "image/jpeg") {
                    echo 'Please upload a .jpg or .png file<br />';
                    $canSave = false;

                } else {
                    $image = session_id() . "-" . $image;
                    move_uploaded_file($tmp_name, "images/$image");
                }

            } else {
                $image = $_POST['currentImage'];
            }

            //add data to database after validation
            if ($canSave == true) {

                try {

                    //connect to AWS db
                    include 'database.php';

                    //update the table with new data
                    if (!empty($movieId)) {

                        $sql = "UPDATE movies SET movieName = :movieName,
                                releaseYear = :releaseYear,
                                imdb = :imdb, directorId = :directorId,
                                image = :image WHERE movieId = :movieId";

                    } else {

                        //set up sql insert command if doesn't exist
                        $sql = "INSERT INTO movies (movieName, releaseYear, imdb, directorId, image)
                                    VALUES (:movieName, :releaseYear, :imdb, :directorId, :image)";
                    }


                    //fill insert parameters with new variables
                    $cmd = $db->prepare($sql);
                    $cmd->bindParam(':movieName', $movieName, PDO::PARAM_STR, 100);
                    $cmd->bindParam(':releaseYear', $releaseYear, PDO::PARAM_INT);
                    $cmd->bindParam(':imdb', $imdb, PDO::PARAM_STR, 10);
                    $cmd->bindParam(':directorId', $directorId, PDO::PARAM_INT, 50);
                    $cmd->bindParam(':image', $image, PDO::PARAM_STR, 100);
                    if (!empty($movieId)) {
                        $cmd->bindParam(':movieId', $movieId, PDO::PARAM_INT);
                    }

                    //execute
                    $cmd->execute();

                    //disconnect db
                    $db = null;

                    echo "Movie Saved";

                    //redirect to movies page
                    header('location:movies.php');
                }

                catch (exception $e) {
                    //redirect to error page
                    header('location:error.php');
                    exit();
                }

            }
        ?>

    </body>
</html>