<?php
//Every ajax request will contain http_x_requested_with server variable
if (isset($_SERVER["HTTP_X_REQUESTED_WITH"])) {
    include("config.php");
    include("Classes/Album.php");
    include("Classes/Artist.php");
    include("Classes/Song.php");
} else {
    include("includes/header.php");
    include("includes/footer.php");
    $url = $_SERVER["REQUEST_URI"];
    echo "<script>openPage('$url')</script>";
    exit();
}
