<?php 

include 'partials/header.php';

$username_email = $_SESSION['signin-data']['username_email'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;

unset($_SESSION['signin-data']);

?>

<?php if (isset($_SESSION["signin"])): ?>
        <div>
            <p style="color: black;">
                <?= $_SESSION["signin"];
                unset($_SESSION["signin"]);
                ?>
            </p>
        </div>
    <?php endif; ?>


<form action="<?= ROOT_URL ?>signin-logic.php" enctype="multipart/form-data" method="POST">

   
    <input type="text" name="username_email" value="<?= $username_email ?>" placeholder="enter username or email"> <br><br>
    <input type="password" name="password" value="<?= $password ?>" name="password" placeholder="enter password"> <br><br>
   
    <input type="submit" name="submit" value="envoyer">

    <small>Don't have an account ? <a href="signin.php">Sign up</a></small>


</form>

<?php include 'partials/footer.php'?>