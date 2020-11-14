<?php
  include_once('../includes/session.php');
  include_once('../database/db_user.php');

  $email = $_POST['email'];
  $password = $_POST['password'];

  // Don't allow certain characters
  if ( !preg_match ("/^[a-zA-Z0-9]@+$/", $email)) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Email can only contain letters and numbers!');
    die(header('Location: ../pages/register.php'));
  }

  try {
    insertUser($email, $password);
    $_SESSION['email'] = $email;
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Signed up and logged in!');
    header('Location: ../pages/list.php');
  } catch (PDOException $e) {
    die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to signup!');
    header('Location: ../pages/register.php');
  }
?>