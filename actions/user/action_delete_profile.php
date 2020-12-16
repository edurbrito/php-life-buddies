<?php
  include_once('../../includes/session.php');
  include_once('../../database/db_user.php');

  $csrf = isset($_POST['csrf']) ? $_POST['csrf'] : NULL;
  if($csrf != $_SESSION['csrf']){
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to delete!');
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  if(!isset($_SESSION['email'])){
    die(header("Location: ../../pages/login.php"));
  }

  $email = $_SESSION['email'];

  try {
    deleteUser($email);

    session_destroy();
    include_once('../../includes/session.php');
    $_SESSION = array();

    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Account Deleted!');
  } 
  catch (Exception $e) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to delete!');
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  header('Location: ../../index.php');
?>