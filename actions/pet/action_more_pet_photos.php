<?php
  include_once('../../includes/session.php');
  include_once('../../database/db_pet.php');

  $csrf = isset($_POST['csrf']) ? $_POST['csrf'] : NULL;
  if($csrf != $_SESSION['csrf']) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to update pet!');
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  if(!isset($_SESSION['email'])){
    die(header("Location: ../../pages/login.php"));
  }

  try {

    $email = $_SESSION['email'];
    $pet = $_POST['pet_id'];

    if(!is_id($pet)){
      throw new Exception('Invalid Pet id');
    }

    if((getPetOwner($pet) == $email) || (getPetAdopter($pet) == $email)) {
      addAllPetPhotos($email, $pet);
      $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Photos Uploaded!');
    }
    else{
      throw new PDOException('User Does Not Own This Pet');
    }

  } catch (Exception $e) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to upload photos!');
  }
  header("Location: ../../pages/pet.php?pet_id={$pet}");
?>