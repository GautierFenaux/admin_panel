<?php 
require 'config/database.php';

// get signup form data if signup button was clicked


if(isset($_POST["submit"])) {

    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    extract($post);

} else {
    header('location:'. ROOT_URL . 'signup.php');
    die();
}

if(strlen($createpassword) < 8 || $confirmpassword < 8) {
    $_SESSION["signup"] = 'Le mot de passe ne peut pas faire moins de 8 caractères.';
}

if($createpassword !== $confirmpassword) {
    $_SESSION["signup"] = 'Les mots de passe ne correspondent pas.';
} else {
    $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);
}


$user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
$user_check_result = mysqli_query($connection, $user_check_query);

if(mysqli_num_rows($user_check_result) > 0) {
    $_SESSION["signup"] = "Le pseudo ou l'email existe déjà";
}


if(isset($_SESSION["signup"])) {
    $_SESSION['signup-data'] = $_POST;
     header('location:'. ROOT_URL . 'signup.php');
    die();
} else {

    $insert_user_query = "INSERT INTO users (firstname, lastname, username, email, password, is_admin) 
    VALUES ('$firstname', '$lastname', '$username', '$email', '$hashed_password', 0)";
    
    $insert_user_result = mysqli_query($connection, $insert_user_query);

    if(!mysqli_errno($connection)) {
        //redirect with success message
        $_SESSION['signup_sucess'] = "Votre profil a été créé.";
        header('location: '. ROOT_URL . 'signin.php');
    }

}