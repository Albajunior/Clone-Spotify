<?php
include("includes/includedFile.php");
?>
<h1 class="pageHeadingBig">You Might Also Like</h1>
<div class="gridViewContainer">
    <?php
    $sql = "SELECT * FROM albums ORDER BY RAND() LIMIT 10";
    $albumQuery = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($albumQuery)) {
        echo "<div class='gridViewItem'><span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $row['id'] . "\")'><img src='" . $row['artworkPath'] . "'/><div class='gridViewInfo'>" . $row['title'] . "</div><span/></div>";
    }
    ?>
</div>