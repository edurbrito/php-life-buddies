<?php

session_start();

if (isset($_SESSION['email'])){
    $email = $_SESSION['email'];
    $name = $_SESSION['name'];
}

function draw_header($page_name, $css_links = NULL)
{
  global $email, $name;
  /**
   * Draws the header for all pages. Receives an username
   * if the user is logged in in order to draw the logout
   * link.
   */ ?>
  <!DOCTYPE html>
  <html>

  <head>
    <title>Adopt A Pet</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/bar.css">
    <?php 
      foreach($css_links as $css) {
        echo '<link rel="stylesheet" href="../css/' . $css . '">';
      }
    ?>
    <script src="../js/main.js" defer></script>
  </head>

  <body>

    <header class="site-bar">
      <a href="/" class="logo"><img src="../css/images/dog.svg" /></a>
      <ul class="upper-ul">
        <?php if ( $name != NULL) { ?>
          <li>
            <a href="../pages/profile.php"><?= $name ?></a>
          </li>
          <li>
            <a href="../actions/action_logout.php">Logout</a>
          </li>
        <?php } else { ?>
          <li>
            <a href="../pages/login.php">Login</a>
          </li>
          <li>
            <a href="../pages/register.php">SignUp</a>
          </li>
        <?php } ?>
      </ul>
      <ul class="lower-ul">
        <li>
          <a href="/">
            Home
          </a>
        </li>
        <li>
          <a href="/pages/adopt-list.php">
            Adopt
          </a>
        </li>
        <li>
          <a href="/pages/new-pet.php">
            Send for Adoption
          </a>
        </li>
        <li>
          <a href="/">
            Contact Us
          </a>
        </li>
      </ul>
      <img class="notification" />
      <a href="/pages/search.php" class="search"><img src="../css/images/loupe.svg" /></a>
      <hr>
    </header>
    <?php
    if ($page_name) {
    ?>
      <section class="top-banner">
        <img src="../css/images/banner.png" />
        <h2>
          <?= $page_name ?>
        </h2>
      </section>
  <?php }
  } ?>

  <?php function draw_footer()
  {
    /**
     * Draws the footer for all pages.
     */ ?>

    <footer>
      <hr>
      Adopt A Pet
    </footer>
  </body>

  </html>
<?php } ?>