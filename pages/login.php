<?php

include_once(dirname(__DIR__) . '/templates/tpl_common.php');

if (isset($_SESSION['email']))
    die(header('Location: ./profile.php'));

draw_header("Login");
?>

<section class="user-form">
    <form method="post" action="../actions/user/action_login.php">
        <input hidden name="csrf" value="<?= $_SESSION['csrf'] ?>">
        <label for="email">Email:</label>
        <input type="email" name="email" placeholder="example@email.com" required>
        <label for="password">Password:</label>
        <input type="password" name="password" placeholder="password" required>
        <input type="submit" value="Login" class="large-text">
    </form>


    <footer>
        <p>Do you want to create an account? <a href="register.php">Sign Up!</a></p>
    </footer>
</section>

<?php
draw_footer();
?>