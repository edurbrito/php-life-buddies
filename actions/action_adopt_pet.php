<?php
  include_once('../database/db_pet.php');

  session_start();

  $email = $_SESSION['email'];
  $pet_id = $_POST['pet_id'];

  try {
    $pet = getPetInfo($pet_id);

    if($email == NULL){
      die(header("Location: ../pages/login.php"));
    }
    else if(getPetOwner($pet_id) == $email || $pet['adoptedBy'] != NULL){
      $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Already added a proposal to pet!');
      die(header("Location: ../pages/pet.php?pet_id={$pet_id}"));
    }

    addPetAdoptionProposal($email, $pet_id);
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Added proposal to pet!');
  } catch (PDOException $e) {
    // die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to add pet proposal!');
  }
  header("Location: ../pages/pet.php?pet_id={$pet_id}");
?>