<?php
  session_start();

  include_once('../database/db_pet.php');

  $user = $_SESSION['email'];
  $name = $_POST['name'];
  $species = $_POST['species'];
  $age = $_POST['age'];
  $color = $_POST['color'];
  $location = $_POST['location'];

  try {

    if(!validate_pet($name, $species, $age, $color, $location))
      return new PDOException('Matching error in on of the inputs');

    $pet_id = insertPet($name, $species, $age, $color, $location, $user);
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Added new pet!');
    header("Location: ../pages/pet.php?pet_id={$pet_id}");
  } catch (PDOException $e) {
    // die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to add pet!');
    header('Location: ../pages/new-pet.php');
  }
?>