<?php

session_start();

if (!isset($_SESSION['email']))
    die(header('Location: ./login.php'));

$msg=!empty($_SESSION['msg'])?$_SESSION['msg']:'';

include_once('../templates/tpl_common.php');

draw_header("Send New Pet For Adoption", array('new_pet.css'));
?>

<section class="pet-container">
    <section class="add-pet-image">
        <!--<ul>
            <li>
                <img src="../images/canary.png" alt="A yellow canary" width="200" height="180">
                <i class="far fa-star fa-2x"></i>
            </li>
            <li>
                <h2 class="large-text">PROPOSALS</h2>
            </li>
            <li>
                <h2 class="large-text">QUESTIONS</h2>
                <div class="questions-box">
                    <input type="text" name="send_question">
                    <i class="fas fa-arrow-circle-up fa-2x"></i>
                </div>
            </li>
        </ul>-->
        <form action="../actions/action_upload_image.php" method="post" enctype="multipart/form-data">
            <h2 class="large-text">Pet Image</h2>
            <p><?= "Please select a file" ?></p>
            <label for="pet-image" class="custom-file-upload"></label>
            <input type="file" name="pet-image[]" id="pet-image" multiple>
            <input type="submit" value="Upload" name="submit" class="large-text">
        </form>
    </section>

    <section class="pet-info">
        <form method="post" action="../actions/action_new_pet.php">
            <label for="name">Name:</label>
            <input type="text" name="name" placeholder="John Doe The Second" required>
            <label for="species">Species:</label>
            <input type="text" name="species" placeholder="Bird" required>
            <label for="age">Age:</label>
            <input type="text" name="age" placeholder="1 year">
            <label for="color">Color:</label>
            <input type="text" name="color" placeholder="Blue">
            <label for="location">Location:</label>
            <input type="text" name="location" placeholder="Down the Street" required>
            <input type="submit" value="Submit" class="large-text">
        </form>
    </section>
</section>

<?php
draw_footer();
?>