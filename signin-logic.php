<?php
require 'config/database.php';
require_once __DIR__ . '/lib/SecurityService.php';


if (isset($_POST["submit"])) {

    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    extract($post);

    $antiCSRF = new \Phppot\SecurityService\securityService();
    $csrfResponse = $antiCSRF->validate();
    if (empty($csrfResponse)) {
        $message = "Security alert: Unable to process your request.";
        $type = "error";
    }

    if (!$username_email) {
        $_SESSION['signin'] = "Username or Email required";
    } elseif (!$password) {
        $_SESSION['signin'] = 'Password required';
    } else {
        // fetch user from database
        $fetch_user_query = "SELECT * FROM users WHERE username='$username_email' OR email='$username_email'";
        $fetch_user_result = mysqli_query($connection, $fetch_user_query);

        if (mysqli_num_rows($fetch_user_result) == 1) {
            //Convert record into associative array
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['password'];
            // Compare passwords from form and database

            if (password_verify($password, $db_password)) {
                // set session for access control
                $_SESSION['user-id'] = $user_record['id'];
                // set session if user is an admin
                
                if ($user_record['is_admin'] == 1) {
                    $_SESSION['user_is_admin'] = true;
                    header('location: ' . ROOT_URL . 'admin/');
                } elseif ($user_record['is_admin'] == 0) {
                    $_SESSION['user_is_admin'] = NULL;
                    header('location: ' . ROOT_URL);
                }
            } else {
                $_SESSION['signin'] = "Please check your input";
            }
        } else {
            $_SESSION['signin'] = 'User not found';
        }
    }
   



    // if any problem, redirect back to signin page with login data

    if (isset($_SESSION['signin'])) {
        $_SESSION['sign-data'] = $_POST;
        header('location: ' . ROOT_URL . 'signin.php');
        die();
    }
} else {
    header('location: ' . ROOT_URL . 'signin.php');
}
