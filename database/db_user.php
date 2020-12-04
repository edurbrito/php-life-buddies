<?php
  include_once('../includes/database.php');

  /**
   * Verifies if a certain email, password combination
   * exists in the database. Use the sha1 hashing function.
   */
  function checkUserPassword($email, $password) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM LoginData WHERE email = ?');
    $stmt->execute(array($email));

    $user = $stmt->fetch();
    return $user !== false && password_verify($password, $user['password']);
  }

  function getUserInfo($email) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM User WHERE email = ?');
    $stmt->execute(array($email));

    $user = $stmt->fetch();
    return $user;
  }

  function insertUser($email, $password, $name, $phone_number) {
    $db = Database::instance()->db();

    $options = ['cost' => 12];

    $stmt = $db->prepare('INSERT INTO LoginData VALUES(?, ?)');
    $stmt->execute(array($email, password_hash($password, PASSWORD_DEFAULT, $options)));
    $stmt = $db->prepare('INSERT INTO User VALUES(?, ?, ?)');
    $stmt->execute(array($email, $name, $phone_number));
  }

  function updateUser($oldemail, $newemail, $password, $name, $phone_number) {
    $db = Database::instance()->db();

    $options = ['cost' => 12];

    $stmt = $db->prepare('UPDATE LoginData SET email = ?, password = ? WHERE email = ?');
    $stmt->execute(array($newemail, password_hash($password, PASSWORD_DEFAULT, $options), $oldemail));
    $stmt = $db->prepare('UPDATE User SET name = ?, phone_number = ? WHERE email = ?');
    $stmt->execute(array($name, $phone_number, $newemail));
  }

  function getUserPets($email) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM Pet WHERE user = ?');
    $stmt->execute(array($email));

    $pets = $stmt->fetchAll();
    return $pets;
  }

  function getUserFavorites($email) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM Pet, Favorite WHERE Favorite.user = ? AND Pet.id = Favorite.pet_id');
    $stmt->execute(array($email));

    $pets = $stmt->fetchAll();
    return $pets;
  }

  function getUserProposals($email) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM Pet, AdoptionProposal WHERE AdoptionProposal.user = ? AND Pet.id = AdoptionProposal.pet_id');
    $stmt->execute(array($email));

    $pets = $stmt->fetchAll();
    return $pets;
  }

  function clean_text($old_text) {
    return preg_replace('/[^\w\d\s\.!,\?]/', '', $old_text);
  }

  function is_name($name){
    return preg_match("/^[a-zA-Z-' ]*$/", $name);
  }

  function is_email($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL);
  }

  function is_phone_number($phone_number) {
    return preg_match("/^\d{9}|\d{3}-\d{3}-\d{3}$/", $phone_number);
  }

  /**
   * Password needs to match:
   * ^: anchored to beginning of string
   * \S*: any set of characters
   * (?=\S{8,}): of at least length 8
   * (?=\S*[a-z]): containing at least one lowercase letter
   * (?=\S*[A-Z]): and at least one uppercase letter
   * (?=\S*[\d]): and at least one number
   * $: anchored to the end of the string
  */
  function is_password($password){
    return preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/", $password);
  }

  function validate_user($name, $email, $phone_number, $password){
    return is_name($name) && is_email($email) && is_phone_number($phone_number) && is_password($password);
  }

?>