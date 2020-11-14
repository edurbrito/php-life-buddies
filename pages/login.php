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

    <section id="login">
    
        <header><h2>Login</h2></header>

        <form method="post" action="../actions/action_login.php">
        <label for="email">Email:</label>
            <br>
            <input type="email" name="email" placeholder="example@email.com" required>
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="password" required>
            <input type="submit" value="Login">
        </form>

        <footer>
            <p>Don't have an account? <a href="register.php">Signup!</a></p>
        </footer>

    </section>

</html>