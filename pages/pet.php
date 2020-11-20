<?php
include_once('../database/db_pet.php');

$pet_id = $_GET['pet_id'];
$pet = getPetInfo($pet_id);

if ($pet_id == NULL || $pet == NULL)
    die(header('Location: ./adopt-list.php'));

$proposals = getPetProposals($pet_id);
$questions = getPetQuestions($pet_id);

session_start();

$owns = $pet['user'] == $_SESSION['email'];
$_SESSION['curr_pet'] = $pet;

include_once('../templates/tpl_common.php');

draw_header("Pet Profile", array('new_pet.css'));
?>

<section class="pet-container">
    <section class="pet-lists">
        <ul>
            <li>
                <img src="../images/canary.png" alt="A yellow canary" width="200" height="180">
                <form action="../actions/action_favorite_pet.php" method="post">
                    <input type="submit" value="Favorite"/>
                </form>
                <i class="far fa-star fa-2x"></i>
            </li>
            <li>
                <h2 class="large-text">PROPOSALS</h2>
                <?php
                foreach ($proposals as $proposal) { ?>
                    <article class="pet-proposals">
                        <h4><?= $proposal['name'] ?></h4>
                        <?php
                        if ($owns && $pet['adoptedBy'] == NULL) {
                        ?>
                        <form class="questions-box" method="post" action="../actions/action_manage_proposal.php?adopter=<?= $proposal['email'] ?>">
                            <input type="submit" name="accept" value="Accept">
                            <input type="submit" name="decline" value="Decline">
                        </form> 
                        <?php
                        } else {
                        ?>
                        <h6>State: <?= $proposal['state'] ?></h6>
                        <?php
                        }
                        ?>
                    </article>
                <?php } ?>
            </li>
            <li>
                <h2 class="large-text">QUESTIONS</h2>
                <?php
                foreach ($questions as $question) { ?>
                    <article class="pet-comments">
                        <!-- <i class="fas fa-angle-right"></i> -->
                        <h4><?= $question['name'] ?></h4>
                        <p><?= $question['question'] ?></p>
                    </article>
                <?php } ?>
                <form class="questions-box" method="post" action="../actions/action_question_pet.php">
                    <input type="text" name="question" placeholder="Your Message" required>
                    <input type="submit">
                    <i class="fas fa-arrow-circle-up fa-2x"></i>
                </form>
            </li>
        </ul>
    </section>

    <section class="pet-info">
        <?php
        if ($owns) {
        ?>
            <form method="post" action="../actions/action_update_pet.php">
                <label for="name">Name:</label>
                <input type="text" name="name" placeholder="John Doe The Second" required value="<?= $pet['name'] ?>">
                <label for="species">Species:</label>
                <input type="text" name="species" placeholder="Bird" required value="<?= $pet['species'] ?>">
                <label for="age">Age:</label>
                <input type="text" name="age" placeholder="1 year" required value="<?= $pet['age'] ?>">
                <label for="color">Color:</label>
                <input type="text" name="color" placeholder="Blue" required value="<?= $pet['color'] ?>">
                <label for="location">Location:</label>
                <input type="text" name="location" placeholder="Down the Street" required value="<?= $pet['location'] ?>">
                <input type="submit" value="Update Info" class="large-text">
            </form>
        <?php } else { ?>
            <form method="post" action="../actions/action_adopt_pet.php">
                <label for="name">Name:</label>
                <input type="text" name="name" placeholder="John Doe The Second" required value="<?= $pet['name'] ?>" disabled>
                <label for="species">Species:</label>
                <input type="text" name="species" placeholder="Bird" required value="<?= $pet['species'] ?>" disabled>
                <label for="age">Age:</label>
                <input type="text" name="age" placeholder="1 year" required value="<?= $pet['age'] ?>" disabled>
                <label for="color">Color:</label>
                <input type="text" name="color" placeholder="Blue" required value="<?= $pet['color'] ?>" disabled>
                <label for="location">Location:</label>
                <input type="text" name="location" placeholder="Down the Street" required value="<?= $pet['location'] ?>" disabled>
                <input type="submit" value="Send Proposal" class="large-text">
            </form>
        <?php } ?>
    </section>
</section>

<?php
draw_footer();
?>