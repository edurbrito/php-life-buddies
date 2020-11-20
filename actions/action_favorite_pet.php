<?php
  include_once('../database/db_pet.php');

  session_start();

  $email = $_SESSION['email'];

  if($email == NULL){
    die(header("Location: ../pages/login.php"));
  }

  $pet = $_SESSION['curr_pet'];

  try {
    addPetToFavorites($email, $pet['id']);
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Added/Removed pet to/from favorites!');
  } catch (PDOException $e) {
    // die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to add pet to favorites!');
  }
  header("Location: ../pages/pet.php?pet_id={$pet['id']}");
?>