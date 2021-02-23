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
                    <!--IMDB drop down list-->
<!--                    <select>-->
<!--                        --><?php
//                        $selected_imdb = 1;
//                        for ( $i=0; $i<=10 ; $i+=0.1)
//                            print '<option value="'.$i.'"'.($i === $selected_imdb ? ' selected="selected"' : '').'>'.$i.'</option>';
//                        ?>
<!--                    </select>-->
                </fieldset>
                <fieldset class="p-2">
                    <label for="director" class="col-2">Director:</label>
                    <input name="director" id="director" />
                </fieldset>

                <!--save button-->
                <button class="offset-3 btn btn-primary p-2">Save</button>
            </form>

        </main>

    </body>
</html>
