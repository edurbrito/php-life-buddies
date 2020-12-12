<?php

include_once('../../includes/session.php');
include_once('../../database/db_user.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  try {
    $csrf = isset($_GET['token']) ? $_GET['token'] : NULL;

    if ($csrf != $_SESSION['csrf'])
      throw new Exception("Wrong token");

    $email = isset($_GET['email']) ? $_GET['email'] : NULL;

    if(!isset($_SESSION['email']) || $email != $_SESSION['email'])
      throw new Exception("Wrong email");

    die(json_encode(getUserNotifications($email)));

  } catch (Exception $e) {
    http_response_code(403);
  }
} else {
  http_response_code(404);
}
