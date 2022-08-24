<?php

class Song
{
    private $_con;
    private $_id;
    private $_mysqliDb;
    private $_title;
    private $_artistId;
    private $_albumId;
    private $_genre;
    private $_duration;
    private $_path;

    public function __construct($con, $id)
    {
        $this->_con = $con;
        $this->_id = $id;
        $query = mysqli_query($this->_con, "SELECT * FROM songs WHERE id = '$this->_id'");

        $this->_mysqliDb = mysqli_fetch_array($query);

        $this->_title = $this->_mysqliDb['title'];
        $this->_artistId = $this->_mysqliDb['artist'];
        $this->_albumId = $this->_mysqliDb['album'];
        $this->_genre = $this->_mysqliDb['genre'];
        $this->_duration = $this->_mysqliDb['duration'];
        $this->_path = $this->_mysqliDb['path'];
    }


    public function getTitle()
    {
        return $this->_title;
    }
    public function getId()
    {
        return $this->_id;
    }
    public function getArtist()
    {
        return new Artist($this->_con, $this->_artistId);
    }
    public function getAlbum()
    {
        return new Album($this->_con, $this->_albumId);
    }
    public function getGenre()
    {
        return $this->_genre;
    }
    public function getDuration()
    {
        return $this->_duration;
    }
    public function getPath()
    {
        return $this->_path;
    }
}
