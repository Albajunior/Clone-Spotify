<?php include("includes/includedFile.php");

if (isset($_GET['id'])) {

    $albumId = $_GET['id'];
} else {

    header("Location:index.php");
}
$album = new Album($con, $albumId);
$artist = $album->getArtist();
?>

<div class="entityInfo">

    <div class="leftSection">
        <img src="<?php echo $album->getartworkPath(); ?>" alt="">
    </div>

    <div class="rightSetion">
        <h2><?php echo $album->getTitle(); ?></h2>
        <p>By <?php echo $artist->getName(); ?></p>
        <p><?php echo $album->getNumberOfSongs(); ?></p>
    </div>
</div>
<div class="trackListContainer">
    <ul class="trackList">
        <?php
        $songIdArray = $album->getSongids();
        $i = 1;
        foreach ($songIdArray as $songId) {
            $albumSong = new Song($con, $songId);
            $albumArtist = $albumSong->getArtist();

            echo "<li class='trackListRow'><div class='trackCount'><button  onclick='setTrack(" . $albumSong->getId() . ", tempPlaylist, true)'><i class ='fad fa-play pl'></i></button><span class='trackNumber'>$i</span></div><div class='trackInfo'><span class='trackName'>" . $albumSong->getTitle() . "</span><span class='artistName'>" . $albumArtist->getName() . "</span></div><div class='trackOptions'><i class='fal fa-ellipsis-h el'></i></div><div class='trackDuration'><span class='duration'>" . $albumSong->getDuration() . "</span></div></li>";

            $i++;
        }

        ?>
        <script>
            var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
            tempPlaylist = JSON.parse(tempSongIds);
        </script>
    </ul>
</div>