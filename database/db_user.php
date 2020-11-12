<?php
  include_once('./includes/database.php');

  /**
   * Verifies if a certain email, password combination
   * exists in the database. Use the sha1 hashing function.
   */
  function checkUserPassword($email, $password) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM user WHERE email = ?');
    $stmt->execute(array($email));

    $user = $stmt->fetch();
    return $user !== false && password_verify($password, $user['password']);
  }

  function insertUser($email, $password) {
    $db = Database::instance()->db();

    $options = ['cost' => 12];

    $stmt = $db->prepare('INSERT INTO user VALUES(?, ?)');
    $stmt->execute(array($email, password_hash($password, PASSWORD_DEFAULT, $options)));
  }

  function getUser(){
    if(isset($_SESSION['email']))
      return $_SESSION['email'];
    else
      return NULL;
  }
?>