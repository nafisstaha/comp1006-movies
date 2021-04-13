<?php
    include 'authentication.php';
    $title = 'Movie Details';
    include 'header.php';
?>

<?php

    //check for adding or editing
    if (!empty($_GET['movieId'])) {
        $movieId = $_GET['movieId'];

        try {

            //connect db
            include 'database.php';
            $sql = "SELECT * FROM movies WHERE movieId = :movieId";

            //run sql query
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':movieId', $movieId, PDO::PARAM_INT);

            //execute
            $cmd->execute();

            $movie = $cmd->fetch();

            //disconnect db
            $db = null;
        }
        catch (exception $e) {

            //redirect to error page
            header('location:error.php');
            exit();
        }

    //if no id
    } else {
        $movie = null;
    }
?>

<main class="container">

    <h1>Movie Details</h1>

    <!--form-->
    <form method="post" action="save-movie.php" enctype="multipart/form-data">

        <!--Movie name-->
        <fieldset class="p-2">
            <label for="movieName" class="col-2">Name: </label>
            <input name="movieName" id="movieName" required maxlength="100" value="<?php echo $movie['movieName']; ?>" />
        </fieldset>

        <!--release year-->
        <fieldset class="p-2">
            <label for="releaseYear" class="col-2">Release Year:</label>
            <input name="releaseYear" id="releaseYear" required type="number" min="1960" max="2021" value="<?php echo $movie['releaseYear']; ?>" />
        </fieldset>

        <!--IMDB-->
        <fieldset class="p-2">
            <label for="imdb" class="col-2">IMDB:</label>
            <input name="imdb" id="imdb" required type="real" min="1" max="10" placeholder="0-10" value="<?php echo $movie['imdb']; ?>" />
        </fieldset>

        <!--director from other database with a drop down list-->
        <fieldset class="p-2">
            <label for="directorId" class="col-2">Director:</label>
            <select name="directorId" id="directorId">

                <?php

                    try {

                        //Connect to db
                        include 'database.php';

                        //read the table in order by names
                        $sql = "SELECT * FROM directors ORDER BY directorName";

                        //run sql query
                        $cmd = $db->prepare($sql);

                        //execute
                        $cmd->execute();

                        //store data in $directors.
                        $directors = $cmd->fetchAll();

                        //add directors to the list
                        foreach ($directors as $d) {

                            if ($movie['directorId'] == $d['directorId']) {
                                echo '<option selected value="' . $d['directorId'] . '">' . $d['directorName'] . '</option>';

                            } else {
                                echo '<option value="' . $d['directorId'] . '">' . $d['directorName'] . '</option>';
                            }
                        }

                        //disconnect db
                        $db = null;
                    }
                    catch (exception $e) {

                        //redirect to error page
                        header('location:error.php');
                        exit();
                    }
                ?>
            </select>
        </fieldset>

        <fieldset class="p-2">
            <label for="image" class="col-2">Image:</label>
            <input name="image" id="image" type="file" accept=".png,.jpg,jpeg" />
        </fieldset>

        <?php
            //display the image if exists
            if ($movie['image'] != null) {
                echo '<div>
                    <img class="offset-2 thumbnail" src="images' . $movie['image'] . '" 
                    alt="Movie Image" />
                    </div>';
            }
        ?>

        <input name="movieId" id="movieId" type="hidden" value="<?php echo $movie['movieId']; ?>" />

        <input name="currentImage" id="currentImage" type="hidden" value="<?php echo $movie['image']; ?>" />

        <button class="offset-3 btn btn-info p-2" >Save</button>

    </form>

</main>

</body>
</html>
