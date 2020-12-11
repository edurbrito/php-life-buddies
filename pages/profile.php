<?php

include_once(dirname(__DIR__) . '/templates/tpl_common.php');
include_once(dirname(__DIR__) . '/database/db_user.php');

if (isset($_GET['user']) && (!isset($_SESSION['email']) || ($_SESSION['email'] != $_GET['user']))) {
    $email = NULL;
    $user = getUserInfo($_GET['user']);
    
    if($user == NULL)
        die(header('Location: ../index.php'));

    $pets = getUserPets($user['email']);
    $favorites = getUserFavorites($user['email']);
    $proposals = getUserProposals($user['email']);
    $adopted = getAdoptedPets($user['email']);
}
else if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $name = $_SESSION['name'];
    $phone_number = $_SESSION['phone_number'];

    $pets = getUserPets($email);
    $favorites = getUserFavorites($email);
    $proposals = getUserProposals($email);
    $adopted = getAdoptedPets($email);
} else {
    die(header('Location: ../index.php'));
}

draw_header("Profile", array('profile.css'),array('register.js'));
?>

<section class="profile-container">
    <section class="profile-lists">
        <ul>
            <li>
                <h2 class="large-text"><?php if ($email != NULL) { ?>YOUR<?php } ?> POSTS</h2>
                <?php if (count($pets) === 0) { ?>
                    <h4>No Pets sent for Adoption</h4>
                <?php } else { ?>
                <?php foreach ($pets as $pet) { ?>
                    <article class="profile-post">
                        <img src="../css/images/dog.svg" />
                        <h4><?= htmlentities($pet['name']) ?>, <?= htmlentities($pet['age']) ?></h4>
                        <a href="/pages/pet.php?pet_id=<?= htmlentities($pet['id']) ?>"><button>View Post</button></a>
                    </article>
                <?php } } ?>
            </li>
            <li>
                <h2 class="large-text"><?php if ($email != NULL) { ?>YOUR<?php } ?> FAVORITES</h2>
                <?php if (count($favorites) === 0) { ?>
                    <h4>No Pets added to Favorites</h4>
                <?php } else { ?>
                <?php foreach ($favorites as $pet) { ?>
                    <article class="profile-post">
                        <img src="../css/images/dog.svg" />
                        <h4><?= htmlentities($pet['name']) ?>, <?= htmlentities($pet['age']) ?></h4>
                        <a href="/pages/pet.php?pet_id=<?= htmlentities($pet['id']) ?>"><button>View Post</button></a>
                    </article>
                <?php } } ?>
            </li>
            <li>
                <h2 class="large-text"><?php if ($email != NULL) { ?>YOUR<?php } ?> PROPOSALS</h2>
                <?php if (count($proposals) === 0) { ?>
                    <h4>No Proposals</h4>
                <?php } else { ?>
                <?php foreach ($proposals as $pet) { ?>
                    <article class="profile-post">
                        <img src="../css/images/dog.svg" />
                        <h4><?= htmlentities($pet['name']) ?>, <?= htmlentities($pet['age']) ?></h4>
                        <a href="/pages/pet.php?pet_id=<?= htmlentities($pet['id']) ?>"><button>View Post</button></a>
                    </article>
                <?php } } ?>
            </li>
            <li>
                <h2 class="large-text"><?php if ($email != NULL) { ?>YOUR<?php } ?> ADOPTED PETS</h2>
                <?php if (count($adopted) === 0) { ?>
                    <h4>No Adopted Pets</h4>
                <?php } else { ?>
                <?php foreach ($adopted as $pet) { ?>
                    <article class="profile-post">
                        <img src="../css/images/dog.svg" />
                        <h4><?= htmlentities($pet['name']) ?>, <?= htmlentities($pet['age']) ?></h4>
                        <a href="/pages/pet.php?pet_id=<?= htmlentities($pet['id']) ?>"><button>View Post</button></a>
                    </article>
                <?php } } ?>
            </li>
        </ul>
    </section>
    <section class="profile-info">
    <?php if ($email != NULL) { ?>
        <form method="post" action="../actions/user/action_update_profile.php">
            <input hidden name="csrf" value="<?= $_SESSION['csrf'] ?>">
            <label for="name">Name:</label>
            <input type="text" name="name" placeholder="Your Name" pattern="^[a-zA-Z-'À-ú ]+$" onkeyup="checkName()" onBlur="checkName()" oninvalid="invalidName(this);" value="<?= htmlentities($name) ?>" required>
            <label for="phone">Phone number:</label>
            <input type="tel" name="phone" placeholder="912345678" pattern="[9]{1}[1,2,3,6]{1}[0-9]{7}" onkeyup="checkPhone()" onBlur="checkPhone()" oninvalid="invalidPhone(this);" value="<?= htmlentities($phone_number) ?>" required>
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="example@email.com" pattern="(^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$)" onkeyup="checkEmail()" onBlur="checkEmail()" value="<?= htmlentities($email) ?>" required>
            <label for="old-password">Current Password:</label>
            <input type="password" name="old-password" placeholder="Verify your current password" required>
            <label for="new-password">New Password:</label>
            <input type="password" name="new-password" placeholder="Insert a new password to update" pattern="^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$" onkeyup="checkPassword()" onBlur="checkPassword()" oninvalid="invalidPassword(this);">
            <input type="submit" value="Save" class="large-text">
        </form>
    <?php } else { ?>
        <form>
            <input hidden name="csrf" value="<?= $_SESSION['csrf'] ?>">
            <h2 class="large-text">User Info</h2>
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