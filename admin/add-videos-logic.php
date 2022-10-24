<?php
require './config/database.php';


date_default_timezone_set('Europe/Paris');

if (isset($_POST["submit"])) {

    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    extract($post);

    $file_name = $_FILES['video']['name'];
    $file_temp = $_FILES['video']['tmp_name'];
    $file_size = $_FILES['video']['size'];

    if ($file_size < 50000000) {
        $file = explode('.', $file_name);
        $end = end($file);
        $allowed_ext = array('avi', 'flv', 'wmv', 'mov', 'mp4');
        if (in_array($end, $allowed_ext)) {
            $name = date("Ymd") . time();
            $location = 'video/' . $name . "." . $end;
            if (move_uploaded_file($file_temp, $location)) {
                mysqli_query($connection, "INSERT INTO `videos` VALUES('', '$name', '$location', '$description', '$title')");
                header('location: ' . ROOT_URL . '/admin/add-videos.php');
            }
        } else {
            echo "<script>alert('Mauvais format de vidéo')</script>";
            header('location: ' . ROOT_URL . '/admin/add-videos.php');
        }
    } else {
        echo "<script>alert('Vidéo trop longue !')</script>";
        header('location: ' . ROOT_URL . '/admin/add-videos.php');
    }
}