<?php

include_once('../templates/tpl_common.php');

draw_header("Adoption List", array('adopt-list.css'));

include_once('../database/db_pet.php');

$pets = getAllPets();

?>

<div class="adopt-list-container">
    <section class="adopt-list">
        <?php
        foreach ($pets as $pet) { ?>
            <article class="adopt-list-item">
                <img src="../css/images/dog.svg" />
                <h3><?= $pet['name'] ?>, <?= $pet['age'] ?></h3>
                <a href="/pages/pet.php?pet_id=<?= $pet['id'] ?>"><button>View Post</button></a>
            </article>
        <?php } ?>
    </section>
</div>


<?php
draw_footer();
?>