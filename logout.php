<?php
require './partials/header.php';

session_destroy();
header('location :'.ROOT_URL);
die();