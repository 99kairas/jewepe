<?php

// $pass = password_hash('jewepe123', PASSWORD_DEFAULT);

// var_dump($pass);
// die;

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

            // Cek ketersediaan data username
            if ($rows != 0) {
                $getPassword = mysqli_fetch_assoc($sql)['password'];

                if (password_verify($password, $getPassword)) {
                    $_SESSION['username'] = $username;
                    $_SESSION['admin_id'] = mysqli_fetch_assoc($sql)['id'];

                    header('Location:admin/index.php');
                } else {
                    header('Location:login.php?pesan=gagal');
                }
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