<?php

require_once './partials/header.php';
include_once './fetch-videos.php';

?>

<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
</style>
<h2>Modal Example</h2>

<!-- Trigger/Open The Modal -->
<?php if (isset($_SESSION['user_is_admin'])) : ?>
    <button id="myBtn">Ajouter une vidéo</button>

    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="add-videos-logic.php" method="POST" enctype="multipart/form-data">
                <label for="video">Fichier vidéo</label>
                <input type="file" name="video" /> <br><br>
                <label for="title">Titre de la vidéo</label>
                <input type="text" name="title" /> <br><br>
                <label for="description">Description</label>
                <input type="text" name="description" /> <br><br>

                <input type="submit" name="submit" value="envoyer">

            </form>
        </div>

    </div>

<?php endif ?>

<?php while ($fetch = mysqli_fetch_array($query)) { ?>
    <h2> <?= $fetch['title'] ?> </h2>
    <p><?= $fetch['description'] ?></p>
    <video width="320" height="240" controls>
        <source src="<?= $fetch['source'] ?>" data-id="<?= $fetch['id'] ?>">
    </video>
    <?php if (isset($_SESSION['user_is_admin'])) : ?>
        <button><a href="delete-video.php?video_id=<?= $fetch['id'] ?>&source=<?= $fetch['source'] ?>">Supprimer</button>
        <button type="submit" name="update" value="modifier"> </button>
    <?php endif ?>

<?php } ?>










<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

<?php

require_once './partials/footer.php';

?>