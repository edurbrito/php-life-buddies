<?php
  include_once('../../includes/session.php');
  include_once('../../database/db_pet.php');

  if(!isset($_SESSION['email'])){
    die('{"type": "error", "content": "Failed to add pet to favorites!"}');
  }

  $email = $_SESSION['email'];

  try {
    $pet_id = NULL;

    if(isset($_GET['pet_id']))
      $pet_id = $_GET['pet_id'];

    if(!is_id($pet_id)){
      throw new Exception('Invalid Pet id');
    }

    if($pet_id != NULL){
      $action = addPetToFavorites($email, $pet_id);
      echo '{"type": "success", "action": "' . $action . '" }';
    }
    else{
      throw new PDOException("No id specified");
    }
  } catch (Exception $e) {
    // die($e->getMessage());
    echo '{"type": "error", "content": "Failed to add pet to favorites!"}';
  }
  
?>