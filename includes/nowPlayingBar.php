<?php
$songQuery = mysqli_query($con, "SELECT id FROM songs ORDER BY rand() LIMIT 10");

$resulArray = array();
while ($row = mysqli_fetch_array($songQuery)) {
    array_push($resulArray, $row['id']);
    // echo $row['id'];
}
$jsonArray = json_encode($resulArray);
?>

<script>
    $(document).ready(function() {
        var newPlaylist = <?php echo $jsonArray; ?>;
        audioElement = new Audio();
        setTrack(newPlaylist[0], newPlaylist, false);
        updateTimeProgressBar(audioElement.audio);

        /** Playback bar star */
        $(".playbackBar .progressBar").mousedown(function() {
            mouseDown = true;
        });

        $("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove", function(e) {
            e.preventDefault();
        });


        $(".playbackBar .progressBar").mousemove(function(e) {

            if (mouseDown) {
                // Set position of song depending on mouse
                timeFromOfsset(e, this);
            }
        });
        $(".playbackBar .progressBar").mouseup(function(e) {
            timeFromOfsset(e, this);
        });
        /** Playback bar end */

        /**Volume bar start  */
        $(".volumeBar .progressBar").mousedown(function() {
            mouseDown = true;
        });
        $(".volumeBar .progressBar").mousemove(function(e) {

            if (mouseDown) {
                // Set position of song depending on mouse
                var percentage = e.offsetX / $(this).width();
                if (percentage >= 0 && percentage <= 1) {
                    audioElement.audio.volume = percentage;
                }

            }
        });
        $(".volumeBar .progressBar").mouseup(function(e) {
            var percentage = e.offsetX / $(this).width();
            if (percentage >= 0 && percentage <= 1) {
                audioElement.audio.volume = percentage;
            }
        });
        /**Volume bar start  */
        $(document).mouseup(function() {
            mouseDown = false;
        })
    });

    function timeFromOfsset(mouse, progressBar) {
        var percentage = mouse.offsetX / $(progressBar).width() * 100;

        var seconds = audioElement.audio.duration * (percentage / 100);
        audioElement.setTime(seconds);
    }

    function prevSong() {
        if (audioElement.audio.currentTime >= 3 || currentIndex == 0) {
            audioElement.setTime(0);
        } else {
            currentIndex = currentIndex - 1;
            setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
        }
    }

    function nextSong() {

        if (repeat) {
            audioElement.setTime(0);
            playSong();
            return;
        }

        if (currentIndex == currentPlaylist - 1) {
            currentIndex = 0;
        } else {
            currentIndex++;
        }
        var trackToPlay = shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
        setTrack(trackToPlay, currentPlaylist, true);

    }

    function setMute() {
        audioElement.audio.muted = !audioElement.audio.muted;
        var iconColor = audioElement.audio.muted ? "#a0a0a0" : "#007f5f";
        $(".controlButton.volume .vol").css("color", iconColor);
    }

    function setShuffle() {
        shuffle = !shuffle;
        var iconColor = shuffle ? "#007f5f" : "#a0a0a0";
        $(".controlButton.shuffle .icon").css("color", iconColor);

        if (shuffle) {
            //Randomize playlist
            shuffleArray(shufflePlaylist);
            currentPlaylist = shufflePlaylist.indexOf(audioElement.currentPlaying.id);
        } else {
            //Shuffle has been desactivated
            //go back to regular playlist
            currentPlaylist = currentPlaylist.indexOf(audioElement.currentPlaying.id);
        }

    }


    function shuffleArray(a) {
        var j, x, i;
        for (i = a.length; i; i--) {
            j = Math.floor(Math.random() * i);
            x = a[i - 1];
            a[i - 1] = a[j];
            a[j] = x;
        }
    }



    function setRepeat() {
        repeat = !repeat;
        var iconColor = repeat ? "#007f5f" : "#a0a0a0";
        $(".controlButton.repeat .repeati").css("color", iconColor);
    }

    function setTrack(trackId, newPlaylist, play) {
        if (newPlaylist != currentPlaylist) {
            currentPlaylist = newPlaylist;
            shufflePlaylist = currentPlaylist.slice();
            shuffleArray(shufflePlaylist);
        }
        if (shuffle) {
            shuffleIndex = shufflePlaylist.indexOf(trackId);
        } else {
            var currentIndex = currentPlaylist.indexOf(trackId);
        }

        pauseSong();

        $.post("includes/handlers/Ajax/getSongJson.php", {
            songId: trackId
        }, function(data) {


            var track = JSON.parse(data);
            $(".trackName span").text(track.title);

            $.post("includes/handlers/Ajax/getArtistJson.php", {
                artistId: track.artist
            }, function(data) {
                var artist = JSON.parse(data);
                $(".artistName span").text(artist.name);

            });

            $.post("includes/handlers/Ajax/getAlbumJson.php", {
                albumId: track.album
            }, function(data) {
                var album = JSON.parse(data);
                $(".albumLink img").attr("src", album.artworkPath);

            });


            audioElement.setTrack(track);
            // playSong();

            if (play) {
                // audioElement.play();
                playSong();
            }
        });


    }

    function playSong() {
        if (audioElement.audio.currentTime == 0) {
            $.post("includes/handlers/Ajax/updatePlays.php", {
                songId: audioElement.currentPlaying.id
            }, function(data) {
                console.log(data);
            });
        }
        $(".controlButton.play").hide();
        $(".controlButton.pause").show();
        audioElement.play();
    }

    function pauseSong() {
        $(".controlButton.pause").hide();
        $(".controlButton.play").show();
        audioElement.pause();
    }
</script>
<div id="nowPlayingBarContainer">
    <div id="nowPlayingBar">
        <div id="nowPlayingLeft">
            <span class="albumLink">
                <img src="" alt="" class="albumArtwork">
            </span>

            <div class="trackInfo">
                <span class="trackName">
                    <span></span>
                </span>
                <span class="artistName">
                    <span></span>
                </span>
            </div>
        </div>

        <div id="nowPlayingCenter">
            <div class="content playerControls">
                <div class="buttons">

                    <button class="controlButton shuffle" title="shuffle button" onclick="setShuffle()">
                        <i class="fal fa-random icon"></i>
                    </button>

                    <button class="controlButton previous" title="shuffle button" onclick="prevSong()">
                        <i class="fad fa-step-backward icon"></i>
                    </button>

                    <button class="controlButton play" title="shuffle button" onclick="playSong()">
                        <i class="fal fa-play-circle icon1"></i>
                    </button>

                    <button class="controlButton pause" title="shuffle button" style="display: none" onclick="pauseSong()">
                        <i class="fad fa-pause-circle icon1"></i>
                    </button>

                    <button class="controlButton next" title="shuffle button" onclick="nextSong()">
                        <i class="fad fa-step-forward icon"></i>
                    </button>

                    <button class="controlButton repeat" title="shuffle button" onclick="setRepeat()">
                        <i class="fal fa-repeat-alt icon repeati"></i>
                    </button>
                </div>

                <div class="playbackBar">
                    <span class="progressTime current">0.00</span>
                    <div class="progressBar">
                        <div class="progressBarBg">
                            <div class="progress"></div>
                        </div>
                    </div>
                    <span class="progressTime remaining">0.00</span>

                </div>
            </div>
        </div>

        <div id="nowPlayingRight">
            <div class="volumeBar">
                <button class="controlButton volume" title="volume button" onclick="setMute()">
                    <i class="fad fa-volume vol"></i>
                </button>
                <div class="progressBar">
                    <div class="progressBarBg">
                        <div class="progress"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>