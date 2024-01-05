<?php

session_start();

// UNSET SESSION
unset($_SESSION['username']);
unset($_SESSION['id']);

// UNSET ALL
session_unset();

// DESTROY SESSION
session_destroy();

// ARAHKAN KE HALAMAN LOGIN
header('Location:../login.php?pesan=logout');

?>