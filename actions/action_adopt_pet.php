<?php
  include_once('../database/db_pet.php');

  session_start();

  $email = $_SESSION['email'];
  $pet = $_SESSION['curr_pet'];

  if($email == NULL){
    die(header("Location: ../pages/login.php"));
  }
  else if($email == $pet['user'] || $pet['adoptedBy'] != NULL){
    die(header("Location: ../pages/pet.php?pet_id={$pet['id']}"));
  }

  try {
    addPetAdoptionProposal($email, $pet['id']);
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Added proposal to pet!');
  } catch (PDOException $e) {
    // die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to add pet proposal!');
  }
  header("Location: ../pages/pet.php?pet_id={$pet['id']}");
?>