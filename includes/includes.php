<?php
include("config.php");
include("Classes/Constants.php");

// function autoLoadClasses($class)
// {
//     include 'Classes/' . $class . '.php';
// }
// spl_autoload_register('autoLoadClasses');

include("Classes/Account.php");
include("Classes/Album.php");
include("Classes/Artist.php");
include("Classes/Song.php");

$account = new Account($con);
include("handlers/register_handler.php");
include("handlers/login_handler.php");
