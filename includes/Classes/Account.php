<?php
class Account
{
    private $_con;
    private $_errorArray;
    public function __construct($con)
    {
        $this->_con = $con;
        $this->_errorArray = array();
    }

    public function login($un, $pw)
    {
        $pw = md5($pw);
        $sql = "SELECT * FROM users WHERE username = '$un'AND password = '$pw'";
        $query = mysqli_query($this->_con, $sql);

        if (mysqli_num_rows($query) == 1) {
            return true;
        } else {
            array_push($this->_errorArray, Constant::$_loginFailed);
            return false;
        }
    }

    public function register($un, $ln, $pw, $pw2, $fn, $em, $em2)
    {
        $this->validateUsername($un);
        $this->validateLastname($ln);
        $this->validatePassword($pw, $pw2);
        $this->validateFirstname($fn);
        $this->validateEmail($em, $em2);

        if (empty($this->_errorArray)) {
            //Insert into db
            return $this->insertUserDetails($un, $ln, $pw, $fn, $em);
        } else {
            return false;
        }
    }

    public function getError($error)
    {
        if (!in_array($error, $this->_errorArray)) {
            $error = "";
        }
        return "<span class='errorMessage'>$error</span>";
    }

    private function insertUserDetails($un, $ln, $pw, $fn, $em)
    {
        $encryptedPassword = md5($pw);
        $profilePic = "Assets/images/profile-pics/profilepic.jpg";
        $date = date("Y-m-d");

        $sql = "INSERT INTO users VALUES('', '$un','$fn','$ln','$em','$encryptedPassword', '$date','$profilePic')";

        $result = mysqli_query($this->_con, $sql);

        return $result;
    }

    private function validateUsername($un)
    {
        if (strlen($un) > 25 || strlen($un) < 5) {
            array_push($this->_errorArray, Constant::$_usernameCharacters);
            return;
        }
        //TODO: check if username exists
        $sql = "SELECT username FROM users WHERE username='$un'";
        $checkUsernameQuery = mysqli_query($this->_con, $sql);

        if (mysqli_num_rows($checkUsernameQuery) != 0) {
            array_push($this->_errorArray, Constant::$_usernameTaken);
        }
    }

    private function validateFirstname($fn)
    {
        if (strlen($fn) > 25 || strlen($fn) < 2) {
            array_push($this->_errorArray, Constant::$_firstNameCharacters);
            return;
        }
    }

    private function validateLastname($ln)
    {
        if (strlen($ln) > 25 || strlen($ln) < 2) {
            array_push($this->_errorArray, Constant::$_lastNameCharacters);
            return;
        }
    }

    private function validateEmail($em, $em2)
    {
        if ($em != $em2) {
            array_push($this->_errorArray, Constant::$_emailsDoNotMatch);
        }
        if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            array_push($this->_errorArray, Constant::$_emailInvalid);
        }

        //TODO: check that username hasn't already been used
        $sql = "SELECT email FROM users WHERE email = '$em'";
        $checkEmailQuery = mysqli_query($this->_con, $sql);

        if (mysqli_num_rows($checkEmailQuery) != 0) {
            array_push($this->_errorArray, Constant::$_emailTaken);
        }
    }

    private function validatePassword($ps, $ps2)
    {
        if ($ps != $ps2) {
            array_push($this->_errorArray, Constant::$_passwordDoNotMatch);
            return;
        }
        if (preg_match('/[^A-Za-z0-9]/', $ps)) {
            array_push($this->_errorArray, Constant::$_passwordNotAlphanumeric);
            return;
        }

        if (strlen($ps) > 30 || strlen($ps) < 8) {
            array_push($this->_errorArray, Constant::$_passwordCharacters);
            return;
        }
    }
}
