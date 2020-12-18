<?php
  include_once('../../includes/session.php');
  include_once('../../database/db_user.php');

  $csrf = isset($_POST['csrf']) ? $_POST['csrf'] : NULL;
  if($csrf != $_SESSION['csrf']){
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to signup!');
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  $email = isset($_POST['email']) ? $_POST['email'] : NULL;
  $password = isset($_POST['password']) ? $_POST['password'] : NULL;
  $name = isset($_POST['name']) ? $_POST['name'] : NULL;
  $phone_number = isset($_POST['phone']) ? $_POST['phone'] : NULL;

  try {
    if(!validate_user($name, $email, $phone_number, $password)){
      throw new Exception("Matching errors in one of the inputs");
    }

    insertUser($email, $password, $name, $phone_number);
    $_SESSION['email'] = $email;
    
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Signed up and logged in!');
    header('Location: ../../pages/adopt-list.php');
  } catch (Exception $e) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to signup!');
    header('Location: ../../pages/register.php');
  }
?>