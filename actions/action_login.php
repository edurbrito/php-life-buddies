<?php
  include_once('../includes/session.php');
  include_once('../database/db_user.php');

  $email = $_POST['email'];
  $password = $_POST['password'];

  if (checkUserPassword($email, $password)) {
    $_SESSION['email'] = $email;
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Logged in successfully!');
    header('Location: ../pages/profile.php');
  } else {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Login failed!');
    header('Location: ../pages/login.php');
  }

?>