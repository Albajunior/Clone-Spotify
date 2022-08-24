<?php
include("includes/includes.php");
function getInputValue($name)
{
    if (isset($_POST[$name])) {
        echo $_POST[$name];
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Assets/css/register.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./Assets/Js/all.js"></script>
    <title>Welcome to Slotify</title>
</head>

<body>
    <?php
    if (isset($_POST['registerButton'])) {
        echo '  <script>
                    $(document).ready(function() {
                        $("#registerForm").show();
                        $("#loginForm").hide();
                    })
                </script>';
    } else {
        echo '    <script>
                        $(document).ready(function() {
                            $("#registerForm").hide();
                            $("#loginForm").show();
                        })
                   </script>';
    }
    ?>

    <div id="bg">
        <div id="logginContainer">
            <div id="inputContainer">
                <form action="register.php" method="POST" id="loginForm">
                    <h2>Login to your account</h2>
                    <p>
                        <?php echo $account->getError(Constant::$_loginFailed); ?>
                        <label for="loginUsername">Username</label>
                        <input type="text" id="loginUsername" name="loginUsername" value="<?php getInputValue('loginUsername') ?>" placeholder="e.g bartSimson" required>
                    </p>
                    <p>
                        <label for="loginPassword">Password</label>
                        <input type="password" id="loginPassword" name="loginPassword" placeholder="Your password" required>
                    </p>

                    <button type="submit" name="loginButton">LOG IN</button>
                    <div class="hasAccountText">
                        <span id="hideLogIn">Don't have an account yet?Signup here.</span>
                    </div>
                </form>


                <form action="register.php" method="POST" id="registerForm">
                    <h2>Create your free account</h2>

                    <p>
                        <?php echo $account->getError(Constant::$_usernameCharacters); ?>
                        <?php echo $account->getError(Constant::$_usernameTaken); ?>
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="e.g bartSimson" value="<?php getInputValue('username') ?>" required>
                    </p>

                    <p>
                        <?php echo $account->getError(Constant::$_firstNameCharacters); ?>
                        <label for="firstName">First name</label>
                        <input type="text" id="firstName" name="firstName" placeholder="e.g bartSimson" value="<?php getInputValue('firstName') ?>" required>
                    </p>

                    <p>
                        <?php echo $account->getError(Constant::$_lastNameCharacters); ?>
                        <label for="lastName">Last name</label>
                        <input type="text" id="lastName" name="lastName" placeholder="e.g bart" value="<?php getInputValue('lastName') ?>" required>
                    </p>

                    <p>
                        <?php echo $account->getError(Constant::$_emailsDoNotMatch); ?>
                        <?php echo $account->getError(Constant::$_emailInvalid); ?>
                        <?php echo $account->getError(Constant::$_emailTaken); ?>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="e.g bartSimson@example.com" value="<?php getInputValue('email') ?>" required>
                    </p>

                    <p>
                        <label for="email2">Confirm email</label>
                        <input type="email" id="email2" name="email2" placeholder="e.g bartSimson@example.com" value="<?php getInputValue('email2') ?>" required>
                    </p>

                    <p>
                        <?php echo $account->getError(Constant::$_passwordDoNotMatch); ?>
                        <?php echo $account->getError(Constant::$_passwordNotAlphanumeric); ?>
                        <?php echo $account->getError(Constant::$_passwordCharacters); ?>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Your password" required>
                    </p>

                    <p>
                        <label for="password2">Confirm password</label>
                        <input type="password" id="password2" name="password2" placeholder="Your password" required>
                    </p>

                    <button type="submit" name="registerButton">SIGN UP</button>

                    <div class="hasAccountText">
                        <span id="hideRegister">Already have an account?Login here.</span>
                    </div>
                </form>
            </div>

            <div id="logingText">
                <h1>Get Great music, right now</h1>
                <h2>Listen to lots of songs for free</h2>
                <ul>
                    <li> <i class="far fa-check-square icon"></i> Discover music you'll fall in love with</li>
                    <li> <i class="far fa-check-square icon"></i> Create your own playlist</li>
                    <li> <i class="far fa-check-square icon"></i> Folow artists to keep up to date</li>
                </ul>


            </div>
        </div>
    </div>
    <script src="./Assets/Js/register.js"></script>
</body>

</html>