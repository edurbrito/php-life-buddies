<?php
  include_once('../database/db_pet.php');

  session_start();

  $email = $_SESSION['email'];

  if($email == NULL){
    die(header("Location: ../pages/login.php"));
  }

  try {
    $pet_id = $POST['pet_id'];
    $action = addPetToFavorites($email, $pet_id);
    if($action == 'added' && $pet_id != NULL)
      echo '{"type": "success", "action": "added" }';
    else
      echo '{"type": "success", "action": "removed" }';
  } catch (PDOException $e) {
    // die($e->getMessage());
    echo '{"type": "error", "content": "Failed to add pet to favorites!"}';
  }
  
?>