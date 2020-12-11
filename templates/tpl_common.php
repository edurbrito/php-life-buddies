<?php

include_once(dirname(__DIR__) . '/includes/session.php');
include_once(dirname(__DIR__) . '/database/db_user.php');

if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
  $name = $_SESSION['name'];
  $notifications = countNotifications($email);
}

if (isset($_SESSION['messages'])) {
  $last_message = end($_SESSION['messages']);
  $_SESSION['messages'] = array();
}

function draw_header($page_name, $css_links = NULL, $js_links = NULL)
{
  global $name, $last_message, $notifications;
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
    foreach ((array)$css_links as $css) {
      echo '<link rel="stylesheet" href="../css/' . $css . '">';
    }
    ?>
    <script src="../js/main.js" defer></script>
    <?php
    foreach ((array)$js_links as $js) {
      echo '<script src="../js/' . $js . '" defer></script>';
    }
    ?>
  </head>

  <body>
    <?php if ($last_message != NULL) {
      if ($last_message['type'] == 'success') {
    ?>
        <div id="snackbar" class="success"><?= $last_message['content'] ?></div>
      <?php } else { ?>
        <div id="snackbar" class="error"><?= $last_message['content'] ?></div>
    <?php }
    } ?>

    <div id="popup" class="overlay">
      <div class="popup">
        <h2>Notifications</h2>
        <a class="close">&times;</a>
        <div class="content" id="popup-content">
          Nothing here...
        </div>
      </div>
    </div>

    <header class="site-bar">
      <a href="/" class="logo"><img src="../css/images/dog.svg" /></a>
      <ul class="upper-ul">
        <?php if ($name != NULL) { ?>
          <li>
            <a href="../pages/profile.php"><?= $name ?></a>
          </li>
          <li>
            <a href="../actions/user/action_logout.php">Logout</a>
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
      <i class="fas fa-bell fa-2x" <?php if($notifications > 0){ echo 'data-count="'. $notifications .'"'; } ?>id="notification"></i>
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