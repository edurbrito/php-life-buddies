<?php

include_once('../templates/tpl_common.php');

if (isset($_SESSION['email']))
    die(header('Location: ./profile.php'));

draw_header("Register");
?>

<script defer src="../js/register.js"></script>
<section class="user-form">
    <form method="post" action="../actions/action_register.php">
        <input hidden name="csrf" value="<?= $_SESSION['csrf'] ?>">
        <label for="name">Name:</label>
        <input type="text" pattern="^[a-zA-Z-'À-ú ]+$" onkeyup="Checkname()" onBlur="Checkname()" oninvalid="InvalidName(this);" oninput="setCustomValidity('')" id="name" name="name" placeholder="name" required>
        <label for="phone">Phone number:</label>
        <input type="tel" name="phone" id="phone" onkeyup="Checkphone()" onBlur="Checkphone()" oninvalid="InvalidPhone(this);" oninput="setCustomValidity('')" placeholder="912345678" pattern="[9]{1}[1,2,3,6]{1}[0-9]{7}" required>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" pattern="(^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$)" onkeyup="CheckEmail()" onBlur="CheckEmail()"placeholder="example@email.com" required>
        <label for="password">Password:</label>
        <input type="password" id="password" pattern="^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$" name="password" onkeyup="CheckPassword()" onBlur="CheckPassword()" oninvalid="InvalidPassword(this);" oninput="setCustomValidity('')" placeholder="password" required>
        <input type="submit" value="Register" class="large-text">
    </form>

    <footer>
        <p>Already have an account? <a href="login.php">Login!</a></p>
    </footer>
</section>


<?php
draw_footer();
?>