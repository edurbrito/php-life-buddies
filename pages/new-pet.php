<?php
    include_once(dirname(__DIR__) . '/templates/tpl_common.php');

    if (!isset($_SESSION['email']))
        die(header('Location: ./login.php'));

    draw_header("Send New Pet For Adoption", array('new_pet.css'), array('new-pet.js'));
?>

<section class="pet-container">    
    <form method="post" action="../actions/pet/action_new_pet.php" enctype="multipart/form-data">
        <input hidden name="csrf" value="<?= $_SESSION['csrf'] ?>">
        <section class="add-pet-image">
            <h2 class="large-text">Pet Images</h2>
            <section id="images-preview"></section>
            <label for="pet-image" class="custom-file-upload"></label>
            <input type="file" name="pet-image[]" id="pet-image" onchange="previewImages(this);" multiple>
        </section>

        <section class="pet-info">
            <label for="name">Name:</label>
            <input type="text" name="name" placeholder="Max, Kitty, Sky, Nemo..." pattern="^[a-zA-Z-'À-ú ]+$" onkeyup="checkName()" onBlur="checkName()" oninvalid="invalidName(this);" required>
            <label for="species">Species:</label>
            <input type="text" name="species" placeholder="Dog, Cat, Bird, Fish..." pattern="^[a-zA-Z-'À-ú ]+$" onkeyup="checkSpecies()" onBlur="checkSpecies()" oninvalid="invalidSpecies(this);" required>
            <label for="age">Age:</label>
            <input type="text" name="age" placeholder="10 years, 4 months, 2 weeks..." pattern="^[a-zA-ZÀ-ú\d' ]+$" onkeyup="checkAge()" onBlur="checkAge()" oninvalid="invalidAge(this);">
            <label for="color">Color:</label>
            <input type="text" name="color" placeholder="Brown, Black, Yellow, Orange..." pattern="^[a-zA-Z-'À-ú ]+$" onkeyup="checkColor()" onBlur="checkColor()" oninvalid="invalidColor(this);">
            <label for="location">Location:</label>
            <input type="text" name="location" placeholder="Pick up address" pattern="^[a-zA-ZÀ-ú\d' ]+$$" onkeyup="checkLocation()" onBlur="checkLocation()" oninvalid="invalidLocation(this);" required>
            <input type="submit" value="Submit" class="large-text">
        </section>
    </form>
</section>

<?php
    draw_footer();
?>