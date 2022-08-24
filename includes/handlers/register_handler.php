<?php
function sanitizeFormPassword($inputText)
{
    $inputText = strip_tags($inputText);
    return $inputText;
}

function sanitizeFormUsername($inputText)
{
    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ", "", $inputText);
    $inputText = htmlentities($inputText);
    return $inputText;
}
function sanitizeFormString($inputText)
{
    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ", "", $inputText);
    $inputText = ucfirst(strtolower($inputText));
    $inputText = htmlentities($inputText);
    return $inputText;
}


if (isset($_POST['registerButton'])) {
    //Register button is pressed
    $username = sanitizeFormUsername($_POST['username']);
    $firstname = sanitizeFormString($_POST['firstName']);
    $lastname = sanitizeFormString($_POST['lastName']);
    $email = sanitizeFormString($_POST['email']);
    $email2 = sanitizeFormString($_POST['email2']);
    $password = sanitizeFormPassword($_POST['password']);
    $password2 = sanitizeFormPassword($_POST['password2']);

    $wasSuccessful = $account->register($username, $lastname, $password, $password2, $firstname, $email, $email2);
    if ($wasSuccessful) {
        $_SESSION["userLoggedIn"] = $username;
        header("Location: index.php");
    }
}
