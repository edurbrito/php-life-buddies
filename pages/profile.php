<?php
    include_once('../includes/session.php');

    if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
        $name = $_SESSION['name'];
        $phone_number = $_SESSION['phone_number'];
    }
    else
        die(header('Location: ../index.php'));
    
    include_once('../templates/tpl_common.php');

    draw_header("Profile", array('profile.css'));
?>

<section class="profile-container">
    <section class="profile-lists">
        <ul>
            <li>
                <h2 class="large-text">YOUR POSTS</h2>
                <article class="profile-post">
                    <img src="../css/images/dog.svg" />
                    <h4>Pet Name, Age</h4>
                    <button>View Post</button>
                </article>
                <article class="profile-post">
                    <img src="../css/images/dog.svg" />
                    <h4>Pet Name, Age</h4>
                    <button>View Post</button>
                </article>
            </li>
            <li>
                <h2 class="large-text">YOUR FAVORITES</h2>
                <article class="profile-post">
                    <img src="../css/images/dog.svg" />
                    <h4>Pet Name, Age</h4>
                    <button>View Post</button>
                </article>
                <article class="profile-post">
                    <img src="../css/images/dog.svg" />
                    <h4>Pet Name, Age</h4>
                    <button>View Post</button>
                </article>
            </li>
            <li>
                <h2 class="large-text">YOUR PROPOSALS</h2>
                <article class="profile-post">
                    <img src="../css/images/dog.svg" />
                    <h4>Pet Name, Age</h4>
                    <button>View Post</button>
                </article>
                <article class="profile-post">
                    <img src="../css/images/dog.svg" />
                    <h4>Pet Name, Age</h4>
                    <button>View Post</button>
                </article>
            </li>
        </ul>
    </section>
    <section class="profile-info">
        <form method="post" action="../actions/action_update_profile.php">
            <label for="name">Name:</label>
            <input type="text" name="name" placeholder="Your Name" value="<?= $name ?>" required>
            <label for="phone">Phone number:</label>
            <input type="tel" name="phone" placeholder="912345678" pattern="[9]{1}[1,2,3,6]{1}[0-9]{7}" value="<?= $phone_number ?>" required>
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="example@email.com" value="<?= $email ?>" required>
            <label for="old-password">Old Password:</label>
            <input type="password" name="old-password" placeholder="Password" required>
            <label for="new-password">New Password:</label>
            <input type="password" name="new-password" placeholder="Password" required>
            <input type="submit" value="Save" class="large-text">
        </form>

    </section>
</section>

<?php
draw_footer();
?>