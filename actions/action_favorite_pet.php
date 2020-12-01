<?php
  include_once('../database/db_pet.php');

  session_start();

  $email = $_SESSION['email'];

  if($email == NULL){
    die(header("Location: ../pages/login.php"));
  }

  try {
    $pet_id = json_decode(file_get_contents('php://input'), true)['pet_id'];
    if($pet_id != NULL){
      $action = addPetToFavorites($email, $pet_id);
      echo '{"type": "success", "action": "' . $action . '" }';
    }
    else{
      throw new PDOException("No id specified");
    }
  } catch (PDOException $e) {
    // die($e->getMessage());
    echo '{"type": "error", "content": "Failed to add pet to favorites!"}';
  }
  
?>