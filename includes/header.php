<?php
include("includes/includes.php");
// session_destroy(); //LogOut

if (isset($_SESSION["userLoggedIn"])) {
    $userLoggedIn = $_SESSION["userLoggedIn"];

    echo "<script> userLoggedIn = '$userLoggedIn';</script>";
} else {
    header("Location: register.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Assets/css/style.css">
    <script src="./Assets/Js/all.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="Assets/Js/script.js"></script>
    <title>Slotify</title>
</head>

<body>

    <div class="mainContainer">

        <!-- ----------------------- TopContainer -----------------------  -->
        <div id="topContainer">
            <!-- ----------------------- Navacontainer ----------------------- -->
            <?php include("includes/navbarConatainer.php"); ?>
            <!-- ----------------------- Navbarcontainer end ----------------------- -->


            <!-- ----------------------- mainViewContainer ----------------------- -->
            <div id="mainViewContainer">
                <div id="mainContent">