<?php
  include_once('../../includes/session.php');
  include_once('../../database/db_pet.php');

  $csrf = isset($_POST['csrf']) ? $_POST['csrf'] : NULL;
  if($csrf != $_SESSION['csrf']){
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to add pet adopter!');
    die(header('Location: ' . $_SERVER['HTTP_REFERER']));
  }

  if(!isset($_SESSION['email'])){
    die(header("Location: ../../pages/login.php"));
  }
  
  try {

    $email = $_SESSION['email'];
    $pet = getPetInfo($_POST['pet_id']);
    $adopter = $_GET['adopter'];
    $accept = $_POST['accept'];
    $decline = $_POST['decline'];
  
    $state = 0;
  
    if($accept != NULL && $decline == NULL) $state = 1;
    else if($accept == NULL && $decline != NULL) $state = -1;
    else $state = 0;
  
    if($email != $pet['user'] || $pet['adoptedBy'] != NULL){
      die(header("Location: ../../pages/pet.php?pet_id={$pet['id']}"));
    }

    if(!is_id($pet['id'])){
      throw new Exception('Invalid Pet id');
    }

    setPetAdoptState($adopter, $pet['id'], $state);
    if($state == 1)
      $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Added adopter to pet!');
    else
      $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Updated Proposal!');
      
  } catch (Exception $e) {
    $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to add pet adopter!');
  }
  header("Location: ../../pages/pet.php?pet_id={$pet['id']}");
?>