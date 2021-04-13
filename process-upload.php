<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Title</title>
    </head>

    <body>

        <?php

            //test uploaded file if exist
            if ($_FILES['file']['name'] != null) {
                $name = $_FILES['file']['name'];
                echo "Name: $name<br />";

                //size bytes. 1 kb = 1024 bytes
                $size = $_FILES['file']['size'];
                echo "Size: $size<br />";

                // temporary cache location
                $tmp_name = $_FILES['file']['tmp_name'];
                echo "Tmp Name: $tmp_name<br />";

                //type
                $type = mime_content_type($tmp_name);
                echo "Type: $type<br />";

                //move file to uploads folder
                move_uploaded_file($tmp_name, "uploads/$name");
            }
            else {
                echo 'No file uploaded';
            }

        ?>

    </body>
</html>