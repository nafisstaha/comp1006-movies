<?php
    $title = 'Register';
    include 'header.php';
?>

<main  class="w-50" style="padding: 10px; margin: 10px;">

    <h1 style="color: #fd7e14">Registration</h1>

    <!--password rules-->
    <p>Password Rules: min 8 characters, 1 digit, 1 upper, 1 lowercase letter</p>

    <!--registration form-->
    <form method="post" action="save-registration.php" class="container align-baseline" style="padding: 10px; margin: 10px;">

        <!--username-->
        <fieldset class="form-group">
            <label for="username" class="col-2">Username:</label>
            <input name="username" id="username" required type="email" placeholder="email@email.com" />
        </fieldset>

        <!--password-->
        <fieldset class="form-group">
            <label for="password" class="col-2">Password:</label>
            <input type="password" name="password" id="password" required
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
        </fieldset>

        <!--confirm password-->
        <fieldset class="form-group">
            <label for="confirm" class="col-2">Confirm Password:</label>
            <input type="password" name="confirm" id="confirm" required
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                   onkeyup="return comparePass();" />
            <span id="pMsg"></span>
        </fieldset>

        <!--comparing password and register button-->
        <div class="offset-3">
            <button class="btn btn-info" onclick="return comparePass();">Register</button>
        </div>

    </form>

</main>

</body>
</html>