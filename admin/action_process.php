<?php

include("config.php");
$db = new database();
session_start();
$admin_id = $_SESSION['id'];


$action = $_GET['action'];

if ($action == "add") {
    // CEK FILE SUDAH DIPILIH ATAU BELUM

    // echo "<pre>";
    // print_r($_FILES);
    // echo "</pre>";
    // die;

    if ($_FILES["image"]["name"] != "") {
        $temporary = explode(".", $_FILES["image"]["name"]); // MEMECAH NAMA FILE DAN EXTENSION
        $ext = end($temporary); // MENGAMBIL EXTENSION
        $fileName = $temporary[0]; // MENGAMBIL NAMA FILE TANPA EXTENSION
        $allowedExtension = array("jpg", "jpeg", "png"); // EXTENSION FILE YANG DIIZINKAN

        if (in_array($ext, $allowedExtension)) { // CEK VALIDASI EXTENSION
            if ($_FILES["image"]["size"] <= 5120000) { // CEK SIZE DENGAN MAX 5MB dalam BYTE
                $name = $fileName . "_" . rand() . "." . $ext;
                $path = "../files/" . $name; // LOKASI UPLOAD FILE
                $uploaded = move_uploaded_file($_FILES["image"]["tmp_name"], $path); // MEMINDAHKAN FILE


                if ($uploaded) {
                    $insertData = $db->addArticle($_POST['title'], $_POST['description'], $_POST['content'], $_POST['status'], $name, $admin_id); // QUERY INSERT DATA

                    if ($insertData) {
                        echo "<script>alert('Data added successfully!');document.location.href = 'index.php';</script>";
                    } else {
                        echo "<script>alert('Data add failed!');document.location.href = 'index.php';</script>";
                    }
                } else {
                    echo "<script>alert('File upload failed!');document.location.href = 'add_article.php';</script>";
                }
            } else {
                echo "<script>alert('File size is too large!');document.location.href = 'add_article.php';</script>";
            }
        } else {
            echo "<script>alert('File type is not allowed!');document.location.href = 'add_article.php';</script>";
        }
    } else {
        echo "<script>alert('Please choose an image file!');document.location.href = 'add_article.php';</script>";
    }
} elseif ($action == "update") {
    // OPERASI UPDATE DATA
    $articleID = $_POST['articleID'];
    if (!empty($articleID)) { // CEK ARTICLE ID TERSEDIA

        if ($_FILES['image']['name'] != '') { // CEK FILE SUDAH DI UPLOAD ATAU TIDAK
            // EKSEKUSI YANG UPLOAD FILE
            $data = $db->getByID($articleID);

            // OPERASI HAPUS FILE
            if (file_exists("../files/" . $data['image']) && $data['image']) {
                unlink("../files/" . $data['image']);

                $temporary = explode(".", $_FILES["image"]["name"]); // MEMECAH NAMA FILE DAN EXTENSION
                $ext = end($temporary); // MENGAMBIL EXTENSION
                $fileName = $temporary[0]; // MENGAMBIL NAMA FILE TANPA EXTENSION
                $allowedExtension = array("jpg", "jpeg", "png"); // EXTENSION FILE YANG DIIZINKAN

                if (in_array($ext, $allowedExtension)) { // CEK VALIDASI EXTENSION
                    if ($_FILES["image"]["size"] <= 5120000) { // CEK SIZE DENGAN MAX 5MB dalam BYTE
                        $name = $fileName . "_" . rand() . "." . $ext;
                        $path = "../files/" . $name; // LOKASI UPLOAD FILE
                        $uploaded = move_uploaded_file($_FILES["image"]["tmp_name"], $path); // MEMINDAHKAN FILE


                        if ($uploaded) {
                            $updateData = $db->editArticle($articleID, $_POST['title'], $_POST['description'], $_POST['content'], $_POST['status'], $name, $admin_id);

                            if ($updateData) {
                                echo "<script>alert('Data updated successfully!');document.location.href = 'index.php';</script>";
                            } else {
                                echo "<script>alert('Data update failed!');document.location.href = 'index.php';</script>";
                            }
                        } else {
                            echo "<script>alert('File upload failed!');document.location.href = 'edit_article?id=" . $articleID . "';</script>";
                        }
                    } else {
                        echo "<script>alert('File size is too large!');document.location.href = 'edit_article.php?id=" . $articleID . "';</script>";
                    }
                } else {
                    echo "<script>alert('File type is not allowed!');document.location.href = 'edit_article.php?id=" . $articleID . "';</script>";
                }
            }

        } else {
            $updateData = $db->editArticle($articleID, $_POST['title'], $_POST['description'], $_POST['content'], $_POST['status'], 'not_set', $admin_id);
            if ($updateData) {
                echo "<script>alert('Data updated successfully!');document.location.href = 'index.php';</script>";
            } else {
                echo "<script>alert('Data update failed!');document.location.href = 'index.php';</script>";
            }
        }

    } else {
        echo "<script>alert('You should choose an article');document.location.href = 'index.php';</script>";
    }
} elseif ($action == "delete") {
    // OPERASI DELETE DATA
    $articleID = $_GET['id'];
    if (!empty($articleID)) {
        // EKSEKUSI HAPUS FILE
        $data = $db->getByID($articleID);

        // DELETE FILE
        if (file_exists("../files/" . $data['image']) && $data['image']) {
            unlink("../files/" . $data['image']);

            $deleteData = $db->deleteArticle($articleID);
        }
    } else {
        echo "<script>alert('You should choose an article');document.location.href = 'index.php';</script>";
    }
} else {
    echo "<script>alert('You don't have permission for this operation!');document.location.href = 'index.php';</script>";
}


?>