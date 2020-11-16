<?php
  
  session_destroy();
  session_start();
  $_SESSION = array();

  $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Logged out!');

  header('Location: ../pages/login.php');
?>