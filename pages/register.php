<?php

if(isset($_SESSION['username']))
    die(header('Location: list.php'));

?>

<!DOCTYPE html>
<html>

    <head>
      <title>Login</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="../css/login.css">
    </head>

    <section id="register">
    
        <header><h2>Register</h2></header>

        <form method="post" action="../actions/action_register.php">
            <label for="name">Name:</label>
            <input type="text" name="name" placeholder="name" required>
            <label for="phone">Phone number:</label>
            <input type="tel" name="phone" placeholder="912345678" pattern="[9]{1}[1,2,3,6]{1}[0-9]{7}" required>
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="example@email.com" required>
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="password" required>
            <input type="submit" value="Register">
        </form>

        <footer>
            <p>Already have an account? <a href="login.php">Login!</a></p>
        </footer>

    </section>

</html>