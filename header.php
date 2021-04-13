<!DOCTYPE html>
<html lang="en">

    <!--head-->
    <head>
        <meta charset="UTF-8">
        <title>Movies | <?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
        <script type="text/javascript" src="js/javascript.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </head>

    <!--body-->
    <body class="bg-light">

    <!--navigation-->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ffe696;">

        <div class="container-fluid">

            <a class="navbar-brand" style="padding: 20px; color: #fd7e14; font-weight: bold" href="index.php">Movies</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="movies.php">The Movies list</a>
                    </li>
                </ul>

                <ul class="nav nav-item">

                    <?php
                    // access current session 1st
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }

                    if (empty($_SESSION['username'])) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <?php
                    }
                    else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><?php echo $_SESSION['username']; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </nav>
