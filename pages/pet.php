<?php
include_once('../templates/tpl_common.php');
include_once('../database/db_pet.php');

if (isset($_GET['pet_id'])) {
    $pet_id = $_GET['pet_id'];
    $pet = getPetInfo($pet_id);

    if ($pet_id == NULL || $pet == NULL)
        die(header('Location: ./adopt-list.php'));

    $proposals = getPetProposals($pet_id);
    $questions = getPetQuestions($pet_id);
    $photos = getPetPhotos($pet_id);

    $owns = getPetOwner($pet_id) == $_SESSION['email'];
    $favorite = isPetFavorite($pet_id, $email);

    draw_header("Pet Profile", array('pet.css'), array('pet.js'));
} else {
    die(header('Location: ./adopt-list.php'));
}

?>
<section class="pet-container" data-id="<?= $pet_id ?>">
    <section class="pet-lists">
        <ul>
            <li>
                <section id="pet-photos">
                    <?php
                        foreach($photos as $key => $photo) {
                            if ($key === array_key_first($photos)) { ?>
                                <img src=<?=$photo['photo']?> alt="Pet photo" width="200" height="200">
                                <br>
                            <?php }
                            else { ?>
                                <img src=<?=$photo['photo']?> alt="Pet photo" width="200" height="200">
                            <?php }
                        }
                    ?>
                </section>
                <?php if ($favorite) { ?>
                    <i class="fas fa-star fa-2x" id="favorite"></i>
                <?php } else { ?>
                    <i class="far fa-star fa-2x" id="favorite"></i>
                <?php } ?>
            </li>
            <li>
                <h2 class="large-text">PROPOSALS</h2>
                <?php
                foreach ($proposals as $proposal) { ?>
                    <article class="pet-proposals">
                        <a href="./profile.php?user=<?= $proposal['email'] ?>">
                            <h4><?= $proposal['name'] ?></h4>
                        </a>
                        <?php
                        if ($owns && $pet['adoptedBy'] == NULL) {
                        ?>
                            <form class="questions-box" method="post" action="../actions/action_manage_proposal.php?adopter=<?= htmlentities($proposal['email']) ?>">
                                <input hidden name="csrf" value="<?= $_SESSION['csrf'] ?>">
                                <input type="submit" name="accept" value="Accept">
                                <input type="submit" name="decline" value="Decline">
                            </form>
                        <?php
                        } else {
                        ?>
                            <h6>State: <?= htmlentities($proposal['state']) ?></h6>
                        <?php
                        }
                        ?>
                    </article>
                <?php } ?>
            </li>
            <li>
                <h2 class="large-text">QUESTIONS</h2>
                <section class="pet-comments">
                    <?php
                    foreach ($questions as $question) { ?>
                        <article class="pet-comment">
                            <i class="fas fa-angle-right"><a href="./profile.php?user=<?= $question['email'] ?>"><span><?= htmlentities($question['name']) ?></a></span></i>
                            <p><?= htmlentities($question['question']) ?></p>
                        </article>
                    <?php } ?>
                </section>
                <form class="questions-box" method="post" action="../actions/action_question_pet.php">
                    <input hidden name="csrf" value="<?= $_SESSION['csrf'] ?>">
                    <input type="text" name="pet_id" value="<?= htmlentities($pet_id) ?>" hidden>
                    <input type="text" name="question" placeholder="Your Message" required>
                    <i class="fas fa-arrow-circle-up fa-2x" id="question"></i>
                </form>
            </li>
        </ul>
    </section>

    <section class="pet-info">
        <?php
        if ($owns) {
        ?>
            <form method="post" action="../actions/action_update_pet.php">
                <h2 class="large-text">PET INFO</h2>
                <input hidden name="csrf" value="<?= $_SESSION['csrf'] ?>">
                <input type="text" name="pet_id" value="<?= htmlentities($pet_id) ?>" hidden>
                <label for="name">Name:</label>
                <input type="text" name="name" placeholder="John Doe The Second" required value="<?= htmlentities($pet['name']) ?>">
                <label for="species">Species:</label>
                <input type="text" name="species" placeholder="Bird" required value="<?= htmlentities($pet['species']) ?>">
                <label for="age">Age:</label>
                <input type="text" name="age" placeholder="1 year" required value="<?= htmlentities($pet['age']) ?>">
                <label for="color">Color:</label>
                <input type="text" name="color" placeholder="Blue" required value="<?= htmlentities($pet['color']) ?>">
                <label for="location">Location:</label>
                <input type="text" name="location" placeholder="Down the Street" required value="<?= htmlentities($pet['location']) ?>">
                <input type="submit" value="Update" class="large-text">
            </form>
        <?php } else { ?>
            <form method="post" action="../actions/action_adopt_pet.php">
                <h2 class="large-text">PET INFO</h2>
                <input hidden name="csrf" value="<?= $_SESSION['csrf'] ?>">            
                <input type="text" name="pet_id" value="<?= htmlentities($pet_id) ?>" hidden>
                <label for="name">Name:</label>
                <p><?= htmlentities($pet['name']) ?></p>
                <label for="species">Species:</label>
                <p><?= htmlentities($pet['species']) ?></p>
                <label for="age">Age:</label>
                <p><?= htmlentities($pet['age']) ?></p>
                <label for="color">Color:</label>
                <p><?= htmlentities($pet['color']) ?></p>
                <label for="location">Location:</label>
                <p><?= htmlentities($pet['location']) ?></p>
                <input type="submit" value="Send Proposal" class="large-text">
            </form>
        <?php } ?>
    </section>
</section>

<?php
draw_footer();
?>