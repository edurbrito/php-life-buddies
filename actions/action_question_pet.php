<?php
  include_once('../database/db_pet.php');
  session_start();

  $email = $_SESSION['email'];

  if($email == NULL){
    die(header("Location: ../pages/login.php"));
  }

  $pet = $_POST['pet_id'];
  $question = clean_text($_POST['question']);

  try {

    if(!is_id($pet)){
      throw new Exception('Invalid Pet id');
    }

    addPetQuestion($email, $pet, $question);
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Added Question to Pet!');
  } catch (Exception $e) {
    // die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to add question to pet!');
  }
  header("Location: ../pages/pet.php?pet_id={$pet}");
?>