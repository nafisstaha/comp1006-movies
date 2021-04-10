<!DOCTYPE html>
<html lang="en">

    <!--head-->
    <head>
        <meta charset="UTF-8">
        <title>Movie Details</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    </head>

    <!--body-->
    <body>

        <main class="container">

            <h1>Movies Details</h1>

            <!--form-->
            <form method="post" action="save-movie.php">

                <!--Movie name-->
                <fieldset class="p-2">
                    <label for="movieName" class="col-2">Name: </label>
                    <input name="movieName" id="movieName" required maxlength="100" />
                </fieldset>

                <!--release year-->
                <fieldset class="p-2">
                    <label for="releaseYear" class="col-2">Release year:</label>

                    <!--year dropdown list from 1980 to 2021-->
                    <select>
                        <?php
                            $selected_year = date('Y');
                            $start_year = 1980;
                            $current_year = 2021;

                            foreach ( range( $current_year, $start_year ) as $i ) {
                                print '<option value="'.$i.'"'.($i === $selected_year ? ' selected="selected"' : '').'>'.$i.'</option>';
                            }
                        ?>
                    </select>

                </fieldset>

                <!--IMDB-->
                <fieldset class="p-2">
                    <label for="imdb" class="col-2">IMDB:</label>
                    <input name="imdb" id="imdb" required type="real" min="1" max="10" />
                </fieldset>

                <!--director from other database with a drop down list-->
                <fieldset class="p-2">
                    <label for="directorId" class="col-2">Director:</label>
                    <select name="directorId" id="directorId">

                        <?php
                            //Connect to AWS db
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
                                echo '<option value="' . $d['directorId'] . '">' . $d['directorName'] . '</option>';
                            }

                            //disconnect db
                            $db = null;
                        ?>
                    </select>
                </fieldset>

                <!--save button-->
                <button class="offset-3 btn btn-primary p-2">Save</button>
            </form>

        </main>

    </body>
</html>
