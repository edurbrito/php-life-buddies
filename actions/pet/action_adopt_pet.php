<?php
  include_once('../../includes/session.php');
  include_once('../../database/db_pet.php');

  $csrf = isset($_POST['csrf']) ? $_POST['csrf'] : NULL;
  if($csrf != $_SESSION['csrf']){
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to add pet proposal!');
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  if(!isset($_SESSION['email'])){
    die(header("Location: ../../pages/login.php"));
  }

  try {

    $email = $_SESSION['email'];
    $pet_id = $_POST['pet_id'];

    if(!is_id($pet_id)){
      throw new Exception('Invalid Pet id');
    }

    $pet = getPetInfo($pet_id);
    
    if(getPetOwner($pet_id) == $email || $pet['adoptedBy'] != NULL){
      $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Cannot add proposal to pet!');
      die(header("Location: ../../pages/pet.php?pet_id={$pet_id}"));
    }

    addPetAdoptionProposal($email, $pet_id);
    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Added proposal to pet!');
    
  } catch (Exception $e) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to add pet proposal!');
  }
  header("Location: ../../pages/pet.php?pet_id={$pet_id}");
?>