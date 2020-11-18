<?php
  include_once('../includes/database.php');

  function insertPet($name, $species, $age, $color, $location, $user) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('INSERT INTO Pet(name, species, age, color, location, user) VALUES(?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($name, $species, $age, $color, $location, $user));

    $stmt = $db->prepare('SELECT * FROM Pet ORDER BY id DESC LIMIT 1');
    $stmt->execute();
    $pet = $stmt->fetch();
    return $pet;
  }

  function getPetInfo($pet_id) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM Pet WHERE id = ?');
    $stmt->execute(array($pet_id));

    $pet = $stmt->fetch();
    return $pet;
  }

  function addPetPhoto($user, $pet_id, $photo){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT user, adoptedBy FROM Pet WHERE id = ?');
    $stmt->execute(array($pet_id));

    $users = $stmt->fetch();

    if($user != $users['user'] && $user != $users['adoptedBy'])
        throw new PDOException();

    $stmt = $db->prepare('INSERT INTO Photo VALUES(?, ?)');
    $stmt->execute(array($pet_id, $photo));
  }

  function petToFavorites($user, $pet_id){
    $db = Database::instance()->db();
    try {
      $stmt = $db->prepare('INSERT INTO Favorite VALUES(?, ?)');
      $stmt->execute(array($user, $pet_id));
    } catch (PDOException $e) {
      $stmt = $db->prepare('DELETE FROM Favorite WHERE user = ? AND pet_id = ?');
      $stmt->execute(array($user, $pet_id));
    }
  }

  function addPetQuestion($user, $pet_id, $question){
    $db = Database::instance()->db();
    $stmt = $db->prepare('INSERT INTO Question VALUES(?, ?, ?)');
    $stmt->execute(array($user, $pet_id, $question));
  }

  function adoptionProposal($user, $pet_id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('INSERT INTO AdoptionProposal VALUES(?, ?)');
    $stmt->execute(array($user, $pet_id));
  }
?>