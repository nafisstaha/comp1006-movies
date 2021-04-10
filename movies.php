<!DOCTYPE html>
<html lang="en">

    <!--head-->
    <head>

        <meta charset="UTF-8">
        <title>movies</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    </head>

    <!--body-->
    <body>

        <?php

            //Connect to AWS db
            include 'database.php';

            //read the table in order by imdb
            $sql = "select * from movies order by imdb desc";

            //run sql query
            $cmd = $db->prepare($sql);

            //execute
            $cmd->execute();

            //store data in $movies.
            $movies = $cmd->fetchAll();

            //table
            echo '<table class="table table-striped table-hover"><thead><th>Name</th><th>Release Year</th><th>IMDB</th><th>Director</th></thead>';

            foreach ($movies as $i) {
                echo '<tr>
                          <td>' . $i['movieName'] . '</td>
                          <td>' . $i['releaseYear'] . '</td>
                          <td>' . $i['imdb'] . '</td>
                          <td>' . $i['directorName'] . '</td>
                      </tr>';
            }

            echo '</table>';

            //disconnect db
            $db = null;
        ?>

    </body>

</html>
