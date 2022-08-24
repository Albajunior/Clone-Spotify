<?php
class Artist
{
    private $_con;
    private $_id;

    public function __construct($con, $id)
    {
        $this->_con = $con;
        $this->_id = $id;
    }
    public function getName()
    {
        $artistQuery = mysqli_query($this->_con, "SELECT name  FROM artists WHERE id='$this->_id'");
        $artist = mysqli_fetch_array($artistQuery);
        return $artist['name'];
    }
}
