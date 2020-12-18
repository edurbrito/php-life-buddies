<?php
  include_once('../../includes/session.php');
  include_once('../../database/db_user.php');

  $csrf = isset($_POST['csrf']) ? $_POST['csrf'] : NULL;
  if($csrf != $_SESSION['csrf']){
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to update!');
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  if(!isset($_SESSION['email'])){
    die(header("Location: ../../pages/login.php"));
  }

  $email = $_SESSION['email'];
  
  $newemail = isset($_POST['email']) ? $_POST['email'] : NULL;
  $oldpassword = isset($_POST['old-password']) ? $_POST['old-password'] : NULL;
  $newpassword =  isset($_POST['new-password']) && $_POST['new-password'] != NULL ? $_POST['new-password'] : $oldpassword;
  $newname = isset($_POST['name']) ? $_POST['name'] : NULL;
  $newphone = isset($_POST['phone']) ? $_POST['phone'] : NULL;

  try {

      if(!validate_user($newname, $newemail, $newphone, $newpassword)){
        throw new Exception("Matching errors in one of the inputs");
      }

      if(checkUserPassword($email,$oldpassword)){
        updateUser($email, $newemail, $newpassword, $newname, $newphone);
        $_SESSION['email'] = $newemail;
        
        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Info Updated!');
      }
      else{
        throw new PDOException("Wrong Password");
      }

  } catch (Exception $e) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to update!');
  }
  header('Location: ../../pages/profile.php');

?>