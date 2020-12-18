<?php
  
  session_destroy();
  include_once('../../includes/session.php');
  $_SESSION = array();

  $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Logged out!');

  header('Location: ../../pages/login.php');
?>