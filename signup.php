<?php 
session_start();
include 'partials/header.php';

$createpassword = $_SESSION["signup-data"]["createpassword"] ?? null;
unset($_SESSION["signup-data"]);

?>


<form action="<?= ROOT_URL ?>signup-logic.php" enctype="multipart/form-data" method="POST">
   <?php if (isset($_SESSION["signup"])): ?>
        <div>
            <p style="color: black;">
                <?= $_SESSION["signup"];
                unset($_SESSION["signup"]);
                ?>
            </p>
        </div>
    <?php endif; ?>

    <input type="text" name="firstname" placeholder="first name"> <br><br>
    <input type="text" name="lastname" placeholder="last name"> <br><br>
    <input type="text" name="username" placeholder="user name"> <br><br>
    <input type="email" name="email" placeholder="email"> <br><br>
    <input type="password" value="<?= $createpassword ?>" name="createpassword" placeholder="create password"> <br><br>
    <input type="password" name="confirmpassword" placeholder="confirm password"> <br><br>
    <label for="avatar">Avatar</label>
    <input type="file">
    <input type="submit" name="submit" value="envoyer">

    <small>Already have an account ? <a href="signin.php">Sign in</a></small>


</form>

<?php include 'partials/footer.php'?>