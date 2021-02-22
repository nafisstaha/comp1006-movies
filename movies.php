<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="UTF-8">
        <title>movies</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />

    </head>

    <body>

        <?php

            //Connect to AWS db
            $db = new PDO('mysql:host=172.31.22.43;dbname=Nafiseh200470752', 'Nafiseh200470752', 'bDjeeJHyam');

            //read the records from table with SQL Query
            $sql = "select * from movies";

            //run the SQL Query
            $cmd = $db->prepare($sql);
            $cmd->execute();

            //store data in $relatives.
            $movies = $cmd->fetchAll();

            //table
            echo '<table class="table table-striped table-hover"><thead><th>Name</th><th>Release Year</th><th>IMDB</th><th>Director</th></thead>';

            foreach ($movies as $i) {
                echo '<tr>
                          <td>' . $i['name'] . '</td>
                          <td>' . $i['releaseYear'] . '</td>
                          <td>' . $i['imdb'] . '</td>
                          <td>' . $i['director'] . '</td>
                      </tr>';
            }
            
            echo '</table>';
            
            //disconnect db
            $db = null;
        ?>
    
    </body>

</html>
