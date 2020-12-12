<?php
  include_once('../../includes/session.php');
  include_once('../../database/db_pet.php');

  $csrf = isset($_POST['csrf']) ? $_POST['csrf'] : NULL;
  if($csrf != $_SESSION['csrf']){
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to add pet!');
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  if(!isset($_SESSION['email'])){
    die(header("Location: ../../pages/login.php"));
  }
  
  try {

    $user = $_SESSION['email'];
    $name = $_POST['name'];
    $species = $_POST['species'];
    $age = $_POST['age'];
    $color = $_POST['color'];
    $location = $_POST['location'];

    if ($msg = invalid_pet($name, $species, $age, $color, $location)) {
      throw new Exception($msg);
    }

    $pet_info = insertPet($name, $species, $age, $color, $location, $user);

    if (addAllPetPhotos($user, $pet_info) < 0) {
      removePet($pet_info['id']);
      throw new Exception('At least one photo of the pet is required');
    }

    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Added new pet!');
    header("Location: ../../pages/pet.php?pet_id={$pet_id}");
    
  } catch (Exception $e) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to add pet! '.$e->getMessage());
    header('Location: ../../pages/new-pet.php');
  }
?>