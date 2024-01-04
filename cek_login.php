<?php

include('admin/config.php');
$db = new database();

// Inisialiasi Session
session_start();

// Cek Session Active
if (isset($_SESSION['username']) || isset($_SESSION['id'])) {
    header('Location: admin/index.php');
} else {
    // Cek apakah form disubmit
    if (isset($_POST['submit'])) {

        // Menghilangkan backslash
        $username = stripslashes($_POST['username']);
        $password = stripslashes($_POST['password']);

        // Cek Nilai Username dan Password apakah kosong?
        if (!empty(trim($username)) && !empty(trim($password))) {
            // SELECT DATA admins BERDASARKAN USERNAME

            $sql = $db->getDataUser($username);

            if ($sql) {
                $rows = mysqli_num_rows($sql);
            } else {
                $rows = 0;
            }

            var_dump($sql);
            die;

            // Cek ketersediaan data username
            if ($rows != 0) {
                echo "Username tersedia";
            } else {
                header('Location:login.php?pesan=notfound');
            }

        } else {
            header('Location:login.php?pesan=empty');
        }
    } else {
        header('Location: login.php?pesan=empty');
    }
}

?>