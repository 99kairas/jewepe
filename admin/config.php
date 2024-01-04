<?php

class database
{
    var $host = 'localhost';
    var $username = 'root';
    var $password = '';
    var $database = 'e_mading_jwp';
    var $conn = '';

    function __construct()
    {
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (mysqli_connect_errno()) {
            echo "Connection to Database Failed: ", mysqli_connect_error();
        }
    }

    // Function baru berfungsi untuk mengambil data (GET DATA)
    public function getDataUser($username)
    {
        $sql = "SELECT * FROM admins WHERE username = '$username'";
        $data = mysqli_query($this->conn, $sql);
        return $data;
    }
}



?>