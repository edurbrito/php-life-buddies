<?php

include_once('../templates/tpl_common.php');

if (isset($_SESSION['email']))
    die(header('Location: ./profile.php'));

draw_header("Register");
?>

<section class="user-form">
    <form method="post" action="../actions/action_register.php">
        <input hidden name="csrf" value="<?= $_SESSION['csrf'] ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" placeholder="name" required>
        <label for="phone">Phone number:</label>
        <input type="tel" name="phone" placeholder="912345678" pattern="[9]{1}[1,2,3,6]{1}[0-9]{7}" required>
        <label for="email">Email:</label>
        <input type="email" name="email" placeholder="example@email.com" required>
        <label for="password">Password:</label>
        <input type="password" name="password" placeholder="password" required>
        <input type="submit" value="Register" class="large-text">
    </form>

    <footer>
        <p>Already have an account? <a href="login.php">Login!</a></p>
    </footer>
</section>


<?php
draw_footer();
?>