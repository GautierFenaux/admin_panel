<?php

include_once './config/database.php';

// Delete video from database and video's source in video folder


$query = "DELETE FROM videos WHERE id='" . $_GET["video_id"] . "'";

if (mysqli_query($connection, $query)) {
    $filepath = dirname(__FILE__) . '/' . $_GET["source"];
    unlink($filepath);
    header('location: ' . ROOT_URL . '/admin/add-videos.php');
} else {
    echo "Error deleting record: " . mysqli_error($connection);
}
mysqli_close($connection);
