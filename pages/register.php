<?php

include_once(dirname(__DIR__) . '/templates/tpl_common.php');

if (isset($_SESSION['email']))
    die(header('Location: ./profile.php'));

draw_header("Register", NULL, array("register.js"));
?>

<section class="user-form">
    <form method="post" action="../actions/user/action_register.php">
        <input hidden name="csrf" value="<?= $_SESSION['csrf'] ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" placeholder="name" pattern="^[a-zA-Z-'À-ú ]+$" onkeyup="checkName()" onBlur="checkName()" oninvalid="invalidName(this);" required>
        <label for="phone">Phone number:</label>
        <input type="tel" name="phone" placeholder="912345678" pattern="[9]{1}[1,2,3,6]{1}[0-9]{7}" onkeyup="checkPhone()" onBlur="checkPhone()" oninvalid="invalidPhone(this);" required>
        <label for="email">Email:</label>
        <input type="email" name="email" placeholder="example@email.com" pattern="(^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$)" onkeyup="checkEmail()" onBlur="checkEmail()" oninvalid="invalidEmail(this);" required>
        <label for="password">Password:</label>
        <input type="password" name="password" placeholder="password" pattern="^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$" onkeyup="checkPassword()" onBlur="checkPassword()" oninvalid="invalidPassword(this);" required>
        <input type="submit" value="Register" class="large-text">
    </form>

    <footer>
        <p>Already have an account? <a href="login.php">Login!</a></p>
    </footer>
</section>


<?php
    draw_footer();
?>