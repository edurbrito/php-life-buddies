<?php
  include_once('../database/db_pet.php');

  $user = $_POST['email'];
  $pet_id = $_POST['pet_id'];

  try {
    petToFavorites($user, $pet_id);
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Added/Removed pet to/from favorites!');
    header('Location: ../pages/pet.php');
  } catch (PDOException $e) {
    // die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to add pet to favorites!');
    header('Location: ../pages/new-pet.php');
  }
?>