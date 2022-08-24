<?php

class Album
{
    private $_con;
    private $_id;
    private $_title;
    private $_artistId;
    private $_genre;
    private $_artworkPath;

    public function __construct($con, $id)
    {
        $this->_con = $con;
        $this->_id = $id;
        $albumQuery = mysqli_query($this->_con, "SELECT * FROM albums WHERE id ='$this->_id'");
        $album = mysqli_fetch_array($albumQuery);
        $this->_title = $album['title'];
        $this->_artistId = $album['artist'];
        $this->_genre = $album['genre'];
        $this->_artworkPath = $album['artworkPath'];
    }

    public function getTitle()
    {
        return $this->_title;
    }


    public function getArtist()
    {
        return new Artist($this->_con, $this->_artistId);
    }

    public function getartworkPath()
    {
        return $this->_artworkPath;
    }

    public function getGenre()
    {
        return $this->_genre;
    }
    public function getNumberOfSongs()
    {
        $query = mysqli_query($this->_con, "SELECT id FROM songs WHERE album = '$this->_id'");

        return mysqli_num_rows($query);
    }
    public function getSongids()
    {
        $query = mysqli_query($this->_con, "SELECT id FROM songs WHERE album = '$this->_id' ORDER BY albumOrder ASC");

        $array = array();

        while ($row = mysqli_fetch_array($query)) {
            array_push($array, $row['id']);
        }
        return $array;
    }
}
