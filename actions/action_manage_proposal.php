<?php
  include_once('../database/db_pet.php');

  session_start();

  $email = $_SESSION['email'];
  $pet = $_SESSION['curr_pet'];
  $adopter = $_GET['adopter'];
  $accept = $_POST['accept'];
  $decline = $_POST['decline'];

  $state = 0;

  if($accept != NULL && $decline == NULL) $state = 1;
  else if($accept == NULL && $decline != NULL) $state = -1;
  else $state = 0;

  if($email == NULL){
    die(header("Location: ../pages/login.php"));
  }
  else if($email != $pet['user'] || $pet['adoptedBy'] != NULL){
    die(header("Location: ../pages/pet.php?pet_id={$pet['id']}"));
  }

  try {

    if(!is_id($pet)){
      throw new PDOException('Invalid Pet id');
    }

    setPetAdoptState($adopter, $pet['id'], $state);
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Added adopter to pet!');
  } catch (PDOException $e) {
    // die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to add pet adopter!');
  }
  header("Location: ../pages/pet.php?pet_id={$pet['id']}");
?>