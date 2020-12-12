<?php
  include_once('../../includes/session.php');
  include_once('../../database/db_user.php');

  $csrf = isset($_POST['csrf']) ? $_POST['csrf'] : NULL;
  if($csrf != $_SESSION['csrf']){
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Login failed!');
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  $email = isset($_POST['email']) ? $_POST['email'] : NULL;
  $password = isset($_POST['password']) ? $_POST['password'] : NULL;

  if (checkUserPassword($email, $password) && validate_user("SomeName", $email, "912345678", $password)) {
    $_SESSION['email'] = $email;
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Logged in successfully!');
    $user = getUserInfo($email);
    
    header('Location: ../../pages/profile.php');
  } else {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Login failed!');
    header('Location: ../../pages/login.php');
  }

?>