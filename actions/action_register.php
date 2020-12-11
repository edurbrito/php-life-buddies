<?php
  include_once('../includes/session.php');
  include_once('../database/db_user.php');

  $csrf = $_POST['csrf'];
  if($csrf != $_SESSION['csrf']){
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to signup!');
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  $email = $_POST['email'];
  $password = $_POST['password'];
  $name = $_POST['name'];
  $phone_number = $_POST['phone'];

  try {
    if(!validate_user($name, $email, $phone_number, $password)){
      throw new Exception("Matching errors in one of the inputs");
    }

    insertUser($email, $password, $name, $phone_number);
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $name;
    $_SESSION['phone_number'] = $phone_number;
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Signed up and logged in!');
    header('Location: ../pages/adopt-list.php');
  } catch (Exception $e) {
    // die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to signup!');
    header('Location: ../pages/register.php');
  }
?>