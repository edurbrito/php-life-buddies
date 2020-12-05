<?php
  include_once('../includes/session.php');
  include_once('../database/db_pet.php');

  if(!isset($_SESSION['email'])){
    die(header("Location: ../pages/login.php"));
  }
  
  $user = $_SESSION['email'];
  $name = $_POST['name'];
  $species = $_POST['species'];
  $age = $_POST['age'];
  $color = $_POST['color'];
  $location = $_POST['location'];

  try {

    if(!validate_pet($name, $species, $age, $color, $location))
      throw new Exception('Matching error in on of the inputs');

    $pet_info = insertPet($name, $species, $age, $color, $location, $user);
    addAllPetPhotos($user, $pet_info);
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Added new pet!');
    header("Location: ../pages/pet.php?pet_id={$pet_id}");
  } catch (Exception $e) {
    // die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to add pet!');
    header('Location: ../pages/new-pet.php');
  }
?>