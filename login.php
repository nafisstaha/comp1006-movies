<?php
    $title = 'Login';
    include 'header.php';
?>

<main style="padding: 10px; margin: 10px;">

    <h1 style="color: #fd7e14">Login</h1>

    <!--login validation-->
    <?php
        if (!empty($_GET['invalid'])) {
            echo '<h5 class="alert alert-danger w-50">Invalid Login</h5>';
        } else {
            echo '<h5 class="alert alert-info w-50">Please enter your credentials</h5>';
        }
    ?>

    <!--login form-->
    <form method="post" action="validation.php" class="container w-50 align-baseline" style="padding: 10px; margin: 10px;">

        <!--username-->
        <fieldset class="form-group">
            <label for="username" class="col-2">Username:</label>
            <input name="username" id="username" required type="email" placeholder="email@email.com" />
        </fieldset>

        <!--password-->
        <fieldset class="form-group">
            <label for="password" class="col-2">Password:</label>
            <input type="password" name="password" id="password" required />
        </fieldset>

        <!--login button-->
        <div class="offset-3">
            <button class="btn btn-info">Login</button>
        </div>

    </form>
</main>

</body>
</html>