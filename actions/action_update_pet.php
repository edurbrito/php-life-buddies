<?php
  session_start();
  include_once('../database/db_pet.php');

  $email = $_SESSION['email'];
  $pet = $_SESSION['curr_pet'];
  $owns = $pet['user'] == $email;

  try {
      if($owns){
        $name = $_POST['name'];
        $species = $_POST['species'];
        $age = $_POST['age'];
        $color = $_POST['color'];
        $location = $_POST['location'];
        updatePet($pet['id'], $name, $species, $age, $color, $location, $email);
        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Pet Updated!');
      }
      else{
        throw new PDOException('User Does Not Own This Pet');
      }

  } catch (PDOException $e) {
    // die($e->getMessage());
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to update pet!');
  }
  header("Location: ../pages/pet.php?pet_id={$pet['id']}");
?>