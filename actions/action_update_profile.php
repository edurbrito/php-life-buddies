<?php
  include_once('../includes/session.php');
  include_once('../database/db_user.php');

  $email = $_SESSION['email'];
  $newemail = $_POST['email'];
  $oldpassword = $_POST['old-password'];
  $newpassword = $_POST['new-password'] != NULL ? $_POST['new-password'] : $oldpassword;
  $newname = $_POST['name'];
  $newphone = $_POST['phone'];

  try {
      if(checkUserPassword($email,$oldpassword)){
        updateUser($email, $newemail, $newpassword, $newname, $newphone);
        $_SESSION['email'] = $newemail;
        $_SESSION['name'] = $newname;
        $_SESSION['phone_number'] = $newphone;
        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Info Updated!');
      }
      else{
        throw new PDOException("Wrong Password");
      }

  } catch (PDOException $e) {
    // die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to update!');
  }
  header('Location: ../pages/profile.php');

?>