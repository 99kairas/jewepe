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
        $data = mysqli_query($this->conn, "SELECT * FROM admins WHERE username = '$username'");
        return $data;
    }
    // GET DATA ARTICLE
    public function showUser()
    {
        $data = mysqli_query($this->conn, "SELECT tba.id, title, description, content, image, status, view, tba.created_at, tba.updated_at, name, tba.admin_id 
        FROM articles tba JOIN admins tbu 
        ON tba.admin_id = tbu.id");

        if ($data) {
            if (mysqli_num_rows($data) > 0) {
                while ($row = mysqli_fetch_array($data)) {
                    $result[] = $row;
                }
            } else {
                $result = 'Data tidak tersedia';
            }
        }

        return $result;
    }

    public function addArticle($title, $description, $content, $status, $image, $admin_id)
    {
        $dateTime = date('Y-m-d H:i:s');
        $insertData = mysqli_query(
            $this->conn,
            "INSERT INTO articles (title, description, content, status, image , created_at, admin_id) 
        VALUES ('$title', '$description', '$content', '$status', '$image', '$dateTime', '$admin_id')"
        );

        return $insertData;
    }
}
?>