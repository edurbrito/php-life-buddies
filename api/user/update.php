<?php

include_once('../../includes/session.php');
include_once('../../database/db_user.php');

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {

  try {
    $csrf = isset($_GET['token']) ? $_GET['token'] : NULL;

    if ($csrf != $_SESSION['csrf'])
      throw new Exception("Wrong token");

    $email = isset($_GET['email']) ? $_GET['email'] : NULL;

    if(!isset($_SESSION['email']) || $email != $_SESSION['email'])
      throw new Exception("Wrong email");

    $user = getUserInfo($email);

    $newemail = isset($_GET['new-email']) ? $_GET['new-email'] : $email;

    $oldpassword = isset($_GET['old-password']) ? $_GET['old-password'] : NULL;
    $newpassword = isset($_GET['new-password']) ? $_GET['new-password'] : $oldpassword;
    
    $newname = isset($_GET['name']) ? $_GET['name'] : $user['name'];
    $newphone = isset($_GET['phone']) ? $_GET['phone'] : $user['phone_number'];

    if (!validate_user($newname, $newemail, $newphone, $newpassword))
      throw new Exception("Wrong params");

    if (checkUserPassword($email, $oldpassword)) {
      
      updateUser($email, $newemail, $newpassword, $newname, $newphone);
      $user = getUserInfo($email);
      die(json_encode($user));

    } else {
      throw new PDOException("Wrong Password");
    }
  } catch (Exception $e) {
    http_response_code(403);
  }
} else {
  http_response_code(404);
}
