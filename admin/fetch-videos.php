<?php

// Retrieve all videos from videos table
$query = mysqli_query($connection, "SELECT * FROM `videos` ORDER BY `id` ASC");
