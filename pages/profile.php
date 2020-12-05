<?php

include_once('../templates/tpl_common.php');
include_once('../database/db_user.php');

if (isset($_GET['user']) && (!isset($_SESSION['email']) || ($_SESSION['email'] != $_GET['user']))) {
    $email = NULL;
    $user = getUserInfo($_GET['user']);
    
    if($user == NULL)
        die(header('Location: ../index.php'));

    $pets = getUserPets($user['email']);
    $favorites = getUserFavorites($user['email']);
    $proposals = getUserProposals($user['email']);
}
else if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $name = $_SESSION['name'];
    $phone_number = $_SESSION['phone_number'];

    $pets = getUserPets($email);
    $favorites = getUserFavorites($email);
    $proposals = getUserProposals($email);
} else {
    die(header('Location: ../index.php'));
}

draw_header("Profile", array('profile.css'));
?>

<section class="profile-container">
    <section class="profile-lists">
        <ul>
            <li>
                <h2 class="large-text"><?php if ($email != NULL) { ?>YOUR<?php } ?> POSTS</h2>
                <?php
                foreach ($pets as $pet) { ?>
                    <article class="profile-post">
                        <img src="../css/images/dog.svg" />
                        <h4><?= htmlentities($pet['name']) ?>, <?= htmlentities($pet['age']) ?></h4>
                        <a href="/pages/pet.php?pet_id=<?= htmlentities($pet['id']) ?>"><button>View Post</button></a>
                    </article>
                <?php } ?>
            </li>
            <li>
                <h2 class="large-text"><?php if ($email != NULL) { ?>YOUR<?php } ?> FAVORITES</h2>
                <?php
                foreach ($favorites as $pet) { ?>
                    <article class="profile-post">
                        <img src="../css/images/dog.svg" />
                        <h4><?= htmlentities($pet['name']) ?>, <?= htmlentities($pet['age']) ?></h4>
                        <a href="/pages/pet.php?pet_id=<?= htmlentities($pet['id']) ?>"><button>View Post</button></a>
                    </article>
                <?php } ?>
            </li>
            <li>
                <h2 class="large-text"><?php if ($email != NULL) { ?>YOUR<?php } ?> PROPOSALS</h2>
                <?php
                foreach ($proposals as $pet) { ?>
                    <article class="profile-post">
                        <img src="../css/images/dog.svg" />
                        <h4><?= htmlentities($pet['name']) ?>, <?= htmlentities($pet['age']) ?></h4>
                        <a href="/pages/pet.php?pet_id=<?= htmlentities($pet['id']) ?>"><button>View Post</button></a>
                    </article>
                <?php } ?>
            </li>
        </ul>
    </section>
    <section class="profile-info">
    <?php if ($email != NULL) { ?>
        <form method="post" action="../actions/action_update_profile.php">
            <input hidden name="csrf" value="<?= $_SESSION['csrf'] ?>">
            <label for="name">Name:</label>
            <input type="text" name="name" placeholder="Your Name" value="<?= htmlentities($name) ?>" required>
            <label for="phone">Phone number:</label>
            <input type="tel" name="phone" placeholder="912345678" pattern="[9]{1}[1,2,3,6]{1}[0-9]{7}" value="<?= htmlentities($phone_number) ?>" required>
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="example@email.com" value="<?= htmlentities($email) ?>" required>
            <label for="old-password">Current Password:</label>
            <input type="password" name="old-password" placeholder="Verify your current password" required>
            <label for="new-password">New Password:</label>
            <input type="password" name="new-password" placeholder="Insert a new password to update">
            <input type="submit" value="Save" class="large-text">
        </form>
    <?php } else { ?>
        <form>
            <input hidden name="csrf" value="<?= $_SESSION['csrf'] ?>">
            <label for="name">Name:</label>
            <p><?= htmlentities($user['name']) ?></p>
            <label for="phone">Phone number:</label>
            <p><?= htmlentities($user['phone_number']) ?></p>
            <label for="email">Email:</label>
            <p><?= htmlentities($user['email']) ?></p>
        </form>
    <?php }?>
    </section>
</section>

<?php
draw_footer();
?>