<?php
    $title = 'The Movies';
    include 'header.php';
?>

<h1>The Movies</h1>

<?php

    //access check, add new movie if the user is logged in
//    if (!empty($_SESSION['username'])) {
//        echo '<a href="movies-details.php">New Movie</a>';
//    }

    try {

        //Connect to AWS db
        include 'database.php';
        //read the table in order by imdb
        $sql = "select * from movies order by imdb desc";
//        $sql = "SELECT movies.*, directors.directorName FROM movies
//                INNER JOIN directors ON movies.directorId = directors.directorId";

        //run sql query
        $cmd = $db->prepare($sql);

        //execute
        $cmd->execute();

        //store data in $movies.
        $movies = $cmd->fetchAll();

        //table
        echo '<table class="table table-striped table-hover">
            <thead>
                <th>Name</th>
                <th></th>
                <th>Release Year</th>
                <th>IMDB score</th>
                <th>Director</th>
                <th></th>
            </thead>';

        //loop for the values in $movies variable. echo is for displaying the title of each movie.
        foreach ($movies as $i) {

            echo '<tr><td>';

            if (!empty($_SESSION['username'])) {
                echo '<a href="movies-details.php?movieId=' . $i['movieId'] . '">
                    ' . $i['movieName'] . '</a>';
            } else {
                echo $i['movieName'];
            }

            echo '</td>';
            echo '<td>';

            //access check, show the image if the user is logged in
            if ($i['image'] != null) {
                echo '<img src="images' . $i['image'] . '" alt="Movie Image"
                class="thumbnail">';
            }

            echo '</td>';
            echo '<td>' . $i['releaseYear'] . '</td>
                   <td>' . $i['imdb'] . '</td>
                   <td>' . $i['directorName'] . '</td>
                   <td>';
//            if (!empty($_SESSION['username'])) {
//                echo '<a href="delete-movie.php?movieId=' . $i['movieId'] . '"
//                   class="btn btn-danger" onclick="return ok();">Delete</a>';
//            }
            echo '</td></tr>';
        }

        echo '</table>';

        //disconnect db
        $db = null;
    }
    catch (exception $e) {
        //redirect to error page
        header('location:error.php');
    }
?>

</body>
</html>
