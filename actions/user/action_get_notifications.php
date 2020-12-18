<?php
  include_once('../../includes/session.php');
  include_once('../../database/db_user.php');

  if(!isset($_SESSION['email'])){
    die("[]");
  }

  die(json_encode(getUserNotifications($_SESSION['email'])));
?>