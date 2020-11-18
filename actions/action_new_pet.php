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
    $pet = insertPet($name, $species, $age, $color, $location, $user);
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Added new pet!');
    header('Location: ../pages/adopt-list.php');
  } catch (PDOException $e) {
    die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to add pet!');
    header('Location: ../pages/new-pet.php');
  }
?>