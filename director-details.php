<!DOCTYPE html>
<html lang="en">

    <!--head-->
    <head>
        <meta charset="UTF-8">
        <title>Director Details</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    </head>

    <!--body-->
    <body>

        <main class="container">

            <h1>Directors Details</h1>

            <!--form-->
            <form method="post" action="save-director.php">

                <fieldset class="p-2">
                    <label for="directorName">Director: </label>
                    <input name="directorName" id="directorName" required maxlength="50"/>
                </fieldset>

                <!--save button-->
                <button class="offset-3 btn btn-primary p-2">Save</button>

            </form>

        </main>

    </body>

</html>